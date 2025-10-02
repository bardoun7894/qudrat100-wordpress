#!/bin/bash

# SSL Certificate Setup Script for WordPress Docker Deployment
# This script sets up Let's Encrypt SSL certificates for production

set -e

# Configuration
DOMAIN_NAME=${DOMAIN_NAME:-"qudrat100.com"}
SSL_EMAIL=${SSL_EMAIL:-"admin@qudrat100.com"}
STAGING=${STAGING:-0}

echo "=== SSL Certificate Setup ==="
echo "Domain: $DOMAIN_NAME"
echo "Email: $SSL_EMAIL"
echo "Staging: $STAGING"
echo "=============================="

# Create necessary directories
mkdir -p docker/ssl
mkdir -p docker/certbot/conf
mkdir -p docker/certbot/www

# Check if certificates already exist
if [ -d "docker/certbot/conf/live/$DOMAIN_NAME" ]; then
    echo "SSL certificates already exist for $DOMAIN_NAME"
    echo "To renew certificates, run: docker-compose exec certbot certbot renew"
    exit 0
fi

# Generate temporary self-signed certificate for initial setup
echo "Generating temporary self-signed certificate..."
openssl req -x509 -nodes -days 1 -newkey rsa:2048 \
    -keyout docker/ssl/privkey.pem \
    -out docker/ssl/fullchain.pem \
    -subj "/C=SA/ST=Riyadh/L=Riyadh/O=Qudrat100/CN=$DOMAIN_NAME"

echo "Temporary certificate generated."

# Start nginx with temporary certificate
echo "Starting nginx with temporary certificate..."
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d nginx

# Wait for nginx to be ready
echo "Waiting for nginx to be ready..."
sleep 10

# Test nginx is responding
if ! curl -k https://$DOMAIN_NAME/nginx-health > /dev/null 2>&1; then
    echo "Warning: nginx health check failed, but continuing..."
fi

# Request Let's Encrypt certificate
echo "Requesting Let's Encrypt certificate..."

if [ "$STAGING" = "1" ]; then
    echo "Using Let's Encrypt staging environment..."
    CERTBOT_ARGS="--staging"
else
    CERTBOT_ARGS=""
fi

# Run certbot
docker-compose -f docker-compose.yml -f docker-compose.prod.yml run --rm certbot \
    certonly --webroot --webroot-path=/var/www/certbot \
    --email $SSL_EMAIL --agree-tos --no-eff-email \
    -d $DOMAIN_NAME -d www.$DOMAIN_NAME $CERTBOT_ARGS

# Check if certificate was obtained
if [ ! -d "docker/certbot/conf/live/$DOMAIN_NAME" ]; then
    echo "Failed to obtain SSL certificate!"
    echo "Please check:"
    echo "1. Domain DNS is pointing to this server"
    echo "2. Port 80 and 443 are open"
    echo "3. Domain is accessible from the internet"
    exit 1
fi

# Copy certificates to nginx ssl directory
echo "Copying certificates to nginx ssl directory..."
cp docker/certbot/conf/live/$DOMAIN_NAME/fullchain.pem docker/ssl/
cp docker/certbot/conf/live/$DOMAIN_NAME/privkey.pem docker/ssl/

# Restart nginx with real certificates
echo "Restarting nginx with real certificates..."
docker-compose -f docker-compose.yml -f docker-compose.prod.yml restart nginx

# Test SSL certificate
echo "Testing SSL certificate..."
sleep 5

if curl -s https://$DOMAIN_NAME/nginx-health > /dev/null; then
    echo "✓ SSL certificate is working correctly!"
else
    echo "⚠ SSL certificate test failed. Please check manually."
fi

# Set up certificate renewal cron job
echo "Setting up certificate renewal..."
cat > docker/scripts/renew-ssl.sh << 'EOF'
#!/bin/bash
cd /path/to/your/wordpress/directory
docker-compose -f docker-compose.yml -f docker-compose.prod.yml run --rm certbot renew
docker-compose -f docker-compose.yml -f docker-compose.prod.yml restart nginx
EOF

chmod +x docker/scripts/renew-ssl.sh

echo ""
echo "=== SSL Setup Complete ==="
echo "✓ SSL certificates obtained and installed"
echo "✓ Nginx configured with SSL"
echo "✓ Certificate renewal script created"
echo ""
echo "Next steps:"
echo "1. Add certificate renewal to crontab:"
echo "   0 12 * * * /path/to/your/wordpress/directory/docker/scripts/renew-ssl.sh"
echo "2. Test your website: https://$DOMAIN_NAME"
echo "3. Test SSL rating: https://www.ssllabs.com/ssltest/analyze.html?d=$DOMAIN_NAME"
echo ""