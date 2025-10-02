# WordPress Docker Production Deployment Guide

This guide provides step-by-step instructions for deploying your WordPress application with custom quiz system to a production server using Docker.

## 📋 Prerequisites

### Server Requirements
- **Operating System**: Ubuntu 20.04+ or CentOS 8+ (recommended)
- **RAM**: Minimum 2GB, recommended 4GB+
- **Storage**: Minimum 20GB SSD
- **CPU**: 2+ cores recommended
- **Network**: Public IP address with ports 80 and 443 open

### Software Requirements
- Docker 20.10+
- Docker Compose 2.0+
- Git
- curl
- openssl

### Domain Setup
- Domain name pointing to your server's IP address
- DNS A record for your domain (e.g., qudrat100.com)
- DNS A record for www subdomain (e.g., www.qudrat100.com)

## 🚀 Quick Start

### 1. Server Preparation

```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker $USER

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

# Logout and login again to apply Docker group changes
```

### 2. Clone and Setup Project

```bash
# Clone your project (replace with your repository)
git clone <your-repository-url> wordpress-app
cd wordpress-app

# Make scripts executable
chmod +x docker/scripts/*.sh
```

### 3. Configure Environment

```bash
# Copy production environment template
cp .env.production .env.production

# Edit environment variables
nano .env.production
```

**Important Environment Variables to Configure:**
```bash
# Domain Configuration
DOMAIN_NAME=qudrat100.com
WORDPRESS_URL=https://qudrat100.com

# Database Configuration
MYSQL_ROOT_PASSWORD=your_secure_root_password
MYSQL_PASSWORD=your_secure_db_password

# WordPress Configuration
WORDPRESS_DB_PASSWORD=your_secure_db_password

# Security Keys (generate at https://api.wordpress.org/secret-key/1.1/salt/)
WORDPRESS_AUTH_KEY=your_auth_key
WORDPRESS_SECURE_AUTH_KEY=your_secure_auth_key
WORDPRESS_LOGGED_IN_KEY=your_logged_in_key
WORDPRESS_NONCE_KEY=your_nonce_key
WORDPRESS_AUTH_SALT=your_auth_salt
WORDPRESS_SECURE_AUTH_SALT=your_secure_auth_salt
WORDPRESS_LOGGED_IN_SALT=your_logged_in_salt
WORDPRESS_NONCE_SALT=your_nonce_salt

# SSL Configuration
SSL_EMAIL=admin@qudrat100.com
```

### 4. Deploy Application

```bash
# Run the deployment script
ENVIRONMENT=production ./docker/scripts/deploy.sh
```

## 📁 Project Structure

```
wordpress-app/
├── docker/
│   ├── apache-config.conf          # Apache configuration
│   ├── nginx.conf                  # Nginx configuration
│   ├── migrate-to-production.php   # Database migration script
│   ├── mysql-init/                 # Database initialization
│   │   └── 01-init-quiz-tables.sql
│   ├── scripts/                    # Deployment scripts
│   │   ├── deploy.sh              # Main deployment script
│   │   └── setup-ssl.sh           # SSL setup script
│   ├── ssl/                       # SSL certificates
│   └── certbot/                   # Let's Encrypt data
├── wp-content/                     # WordPress content
├── .env.production                 # Production environment variables
├── .env.development               # Development environment variables
├── .env.staging                   # Staging environment variables
├── Dockerfile                     # WordPress container definition
├── docker-compose.yml             # Base Docker Compose configuration
├── docker-compose.prod.yml        # Production overrides
└── DEPLOYMENT.md                  # This file
```

## 🔧 Manual Deployment Steps

If you prefer to deploy manually or need to troubleshoot:

### 1. Start Database

```bash
# Load environment variables
export $(cat .env.production | grep -v '^#' | xargs)

# Start database
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d db

# Wait for database to be ready
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f db
```

### 2. Start WordPress

```bash
# Start WordPress
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d wordpress

# Check WordPress logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f wordpress
```

### 3. Run Database Migration

```bash
# Copy migration script to container
docker cp docker/migrate-to-production.php $(docker-compose -f docker-compose.yml -f docker-compose.prod.yml ps -q wordpress):/var/www/html/

# Run migration
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec wordpress php migrate-to-production.php

# Remove migration script
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec wordpress rm -f /var/www/html/migrate-to-production.php
```

### 4. Setup SSL

```bash
# Run SSL setup script
./docker/scripts/setup-ssl.sh
```

### 5. Start Nginx

```bash
# Start Nginx reverse proxy
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d nginx
```

## 🔍 Verification

### Check Services Status

```bash
# Check all services
docker-compose -f docker-compose.yml -f docker-compose.prod.yml ps

# Check logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs
```

### Test Website

```bash
# Test HTTP redirect
curl -I http://qudrat100.com

# Test HTTPS
curl -I https://qudrat100.com

# Test WordPress admin
curl -I https://qudrat100.com/wp-admin/

# Test custom quiz
curl -I https://qudrat100.com/wp-content/themes/twentytwentyfour/quiz-app/
```

### SSL Certificate Test

```bash
# Check SSL certificate
openssl s_client -connect qudrat100.com:443 -servername qudrat100.com

# Test SSL rating (external)
# Visit: https://www.ssllabs.com/ssltest/analyze.html?d=qudrat100.com
```

## 🔄 Maintenance

### Update Application

```bash
# Pull latest changes
git pull origin main

# Rebuild and restart
docker-compose -f docker-compose.yml -f docker-compose.prod.yml build wordpress
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d wordpress
```

### Backup Database

```bash
# Create backup
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec db mysqldump -u root -p wordpress_prod > backup_$(date +%Y%m%d_%H%M%S).sql
```

### Restore Database

```bash
# Restore from backup
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec -T db mysql -u root -p wordpress_prod < backup_file.sql
```

### Renew SSL Certificates

```bash
# Manual renewal
docker-compose -f docker-compose.yml -f docker-compose.prod.yml run --rm certbot renew
docker-compose -f docker-compose.yml -f docker-compose.prod.yml restart nginx

# Setup automatic renewal (add to crontab)
0 12 * * * /path/to/your/wordpress-app/docker/scripts/renew-ssl.sh
```

### Monitor Logs

```bash
# Follow all logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f

# Follow specific service logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f wordpress
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f nginx
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f db
```

## 🚨 Troubleshooting

### Common Issues

#### 1. SSL Certificate Issues

```bash
# Check if domain is accessible
ping qudrat100.com

# Check DNS propagation
nslookup qudrat100.com

# Test port 80 accessibility
curl -I http://qudrat100.com/.well-known/acme-challenge/test

# Use staging environment for testing
STAGING=1 ./docker/scripts/setup-ssl.sh
```

#### 2. Database Connection Issues

```bash
# Check database logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs db

# Test database connection
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec db mysql -u root -p

# Reset database password
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec db mysql -u root -p -e "ALTER USER 'wordpress_user'@'%' IDENTIFIED BY 'new_password';"
```

#### 3. WordPress Issues

```bash
# Check WordPress logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs wordpress

# Access WordPress container
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec wordpress bash

# Check file permissions
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec wordpress ls -la /var/www/html/
```

#### 4. Nginx Issues

```bash
# Check Nginx configuration
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec nginx nginx -t

# Check Nginx logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs nginx

# Restart Nginx
docker-compose -f docker-compose.yml -f docker-compose.prod.yml restart nginx
```

### Performance Optimization

#### 1. Enable Redis Caching

```bash
# In .env.production
REDIS_ENABLED=1

# Restart services
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d redis
```

#### 2. Enable Monitoring

```bash
# In .env.production
MONITORING_ENABLED=1

# Start monitoring services
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d prometheus grafana
```

#### 3. Optimize Database

```bash
# Access database
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec db mysql -u root -p wordpress_prod

# Run optimization queries
OPTIMIZE TABLE wp_posts;
OPTIMIZE TABLE wp_options;
OPTIMIZE TABLE questions;
OPTIMIZE TABLE quiz_sessions;
```

## 🔐 Security Checklist

- [ ] Strong passwords for all database users
- [ ] WordPress security keys configured
- [ ] SSL certificates installed and working
- [ ] Firewall configured (ports 22, 80, 443 only)
- [ ] Regular backups scheduled
- [ ] WordPress and plugins updated
- [ ] File permissions properly set
- [ ] Debug mode disabled in production
- [ ] Database access restricted
- [ ] Admin user with strong password

## 📞 Support

For issues and questions:

1. Check the troubleshooting section above
2. Review Docker and service logs
3. Verify environment configuration
4. Test individual components

## 📝 Environment Variables Reference

### Required Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `DOMAIN_NAME` | Your domain name | `qudrat100.com` |
| `WORDPRESS_URL` | Full WordPress URL | `https://qudrat100.com` |
| `MYSQL_ROOT_PASSWORD` | MySQL root password | `secure_root_pass` |
| `MYSQL_PASSWORD` | WordPress database password | `secure_db_pass` |
| `SSL_EMAIL` | Email for SSL certificates | `admin@qudrat100.com` |

### Optional Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `REDIS_ENABLED` | Enable Redis caching | `0` |
| `BACKUP_ENABLED` | Enable automatic backups | `0` |
| `MONITORING_ENABLED` | Enable monitoring | `0` |
| `WORDPRESS_DEBUG` | Enable WordPress debug | `false` |
| `WORDPRESS_MEMORY_LIMIT` | PHP memory limit | `256M` |

This completes your production deployment setup. Your WordPress application with custom quiz system is now ready for production use!