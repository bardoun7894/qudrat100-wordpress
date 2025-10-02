#!/bin/bash

# WordPress Docker Quick Start Script
# This script provides an interactive setup for WordPress deployment

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m'

# ASCII Art
echo -e "${BLUE}"
cat << "EOF"
 ██╗    ██╗ ██████╗ ██████╗ ██████╗ ██████╗ ██████╗ ███████╗███████╗███████╗
 ██║    ██║██╔═══██╗██╔══██╗██╔══██╗██╔══██╗██╔══██╗██╔════╝██╔════╝██╔════╝
 ██║ █╗ ██║██║   ██║██████╔╝██║  ██║██████╔╝██████╔╝█████╗  ███████╗███████╗
 ██║███╗██║██║   ██║██╔══██╗██║  ██║██╔═══╝ ██╔══██╗██╔══╝  ╚════██║╚════██║
 ╚███╔███╔╝╚██████╔╝██║  ██║██████╔╝██║     ██║  ██║███████╗███████║███████║
  ╚══╝╚══╝  ╚═════╝ ╚═╝  ╚═╝╚═════╝ ╚═╝     ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝
                                                                              
                    Docker Deployment Quick Start
EOF
echo -e "${NC}"

# Functions
log() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if running as root
if [ "$EUID" -eq 0 ]; then
    error "Please don't run this script as root!"
    exit 1
fi

# Welcome message
echo -e "${PURPLE}Welcome to WordPress Docker Quick Start!${NC}"
echo "This script will help you deploy your WordPress application with custom quiz system."
echo ""

# Environment selection
echo -e "${YELLOW}Select deployment environment:${NC}"
echo "1) Development (localhost)"
echo "2) Staging (staging.yourdomain.com)"
echo "3) Production (yourdomain.com)"
echo ""
read -p "Enter your choice (1-3): " env_choice

case $env_choice in
    1)
        ENVIRONMENT="development"
        ENV_FILE=".env.development"
        ;;
    2)
        ENVIRONMENT="staging"
        ENV_FILE=".env.staging"
        ;;
    3)
        ENVIRONMENT="production"
        ENV_FILE=".env.production"
        ;;
    *)
        error "Invalid choice. Exiting."
        exit 1
        ;;
esac

log "Selected environment: $ENVIRONMENT"

# Check if environment file exists
if [ ! -f "$ENV_FILE" ]; then
    error "Environment file $ENV_FILE not found!"
    log "Creating $ENV_FILE from template..."
    
    if [ -f "$ENV_FILE.template" ]; then
        cp "$ENV_FILE.template" "$ENV_FILE"
    else
        error "Template file $ENV_FILE.template not found!"
        exit 1
    fi
fi

# Interactive configuration
echo ""
echo -e "${YELLOW}Configuration Setup${NC}"
echo "Please provide the following information:"

# Domain configuration
if [ "$ENVIRONMENT" = "production" ]; then
    read -p "Enter your domain name (e.g., qudrat100.com): " domain_name
    read -p "Enter your email for SSL certificates: " ssl_email
    
    # Update environment file
    sed -i "s/DOMAIN_NAME=.*/DOMAIN_NAME=$domain_name/" "$ENV_FILE"
    sed -i "s/SSL_EMAIL=.*/SSL_EMAIL=$ssl_email/" "$ENV_FILE"
    sed -i "s|WORDPRESS_URL=.*|WORDPRESS_URL=https://$domain_name|" "$ENV_FILE"
fi

# Database configuration
echo ""
echo -e "${YELLOW}Database Configuration${NC}"
read -s -p "Enter MySQL root password: " mysql_root_pass
echo ""
read -s -p "Enter WordPress database password: " mysql_db_pass
echo ""

# Update passwords in environment file
sed -i "s/MYSQL_ROOT_PASSWORD=.*/MYSQL_ROOT_PASSWORD=$mysql_root_pass/" "$ENV_FILE"
sed -i "s/MYSQL_PASSWORD=.*/MYSQL_PASSWORD=$mysql_db_pass/" "$ENV_FILE"
sed -i "s/WORDPRESS_DB_PASSWORD=.*/WORDPRESS_DB_PASSWORD=$mysql_db_pass/" "$ENV_FILE"

# WordPress security keys
echo ""
echo -e "${YELLOW}WordPress Security Keys${NC}"
read -p "Generate new WordPress security keys? (y/N): " generate_keys

if [[ $generate_keys =~ ^[Yy]$ ]]; then
    log "Generating WordPress security keys..."
    
    # Generate random keys
    AUTH_KEY=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    SECURE_AUTH_KEY=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    LOGGED_IN_KEY=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    NONCE_KEY=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    AUTH_SALT=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    SECURE_AUTH_SALT=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    LOGGED_IN_SALT=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    NONCE_SALT=$(openssl rand -base64 64 | tr -d "=+/" | cut -c1-64)
    
    # Update environment file
    sed -i "s/WORDPRESS_AUTH_KEY=.*/WORDPRESS_AUTH_KEY=$AUTH_KEY/" "$ENV_FILE"
    sed -i "s/WORDPRESS_SECURE_AUTH_KEY=.*/WORDPRESS_SECURE_AUTH_KEY=$SECURE_AUTH_KEY/" "$ENV_FILE"
    sed -i "s/WORDPRESS_LOGGED_IN_KEY=.*/WORDPRESS_LOGGED_IN_KEY=$LOGGED_IN_KEY/" "$ENV_FILE"
    sed -i "s/WORDPRESS_NONCE_KEY=.*/WORDPRESS_NONCE_KEY=$NONCE_KEY/" "$ENV_FILE"
    sed -i "s/WORDPRESS_AUTH_SALT=.*/WORDPRESS_AUTH_SALT=$AUTH_SALT/" "$ENV_FILE"
    sed -i "s/WORDPRESS_SECURE_AUTH_SALT=.*/WORDPRESS_SECURE_AUTH_SALT=$SECURE_AUTH_SALT/" "$ENV_FILE"
    sed -i "s/WORDPRESS_LOGGED_IN_SALT=.*/WORDPRESS_LOGGED_IN_SALT=$LOGGED_IN_SALT/" "$ENV_FILE"
    sed -i "s/WORDPRESS_NONCE_SALT=.*/WORDPRESS_NONCE_SALT=$NONCE_SALT/" "$ENV_FILE"
    
    success "WordPress security keys generated!"
fi

# Optional features
echo ""
echo -e "${YELLOW}Optional Features${NC}"

read -p "Enable Redis caching? (y/N): " enable_redis
if [[ $enable_redis =~ ^[Yy]$ ]]; then
    sed -i "s/REDIS_ENABLED=.*/REDIS_ENABLED=1/" "$ENV_FILE"
fi

read -p "Enable automatic backups? (y/N): " enable_backup
if [[ $enable_backup =~ ^[Yy]$ ]]; then
    sed -i "s/BACKUP_ENABLED=.*/BACKUP_ENABLED=1/" "$ENV_FILE"
fi

if [ "$ENVIRONMENT" = "production" ]; then
    read -p "Enable monitoring (Prometheus/Grafana)? (y/N): " enable_monitoring
    if [[ $enable_monitoring =~ ^[Yy]$ ]]; then
        sed -i "s/MONITORING_ENABLED=.*/MONITORING_ENABLED=1/" "$ENV_FILE"
    fi
fi

# Deployment options
echo ""
echo -e "${YELLOW}Deployment Options${NC}"

backup_before_deploy="1"
if [ "$ENVIRONMENT" = "production" ]; then
    read -p "Create backup before deployment? (Y/n): " backup_choice
    if [[ $backup_choice =~ ^[Nn]$ ]]; then
        backup_before_deploy="0"
    fi
fi

run_migrations="1"
read -p "Run database migrations? (Y/n): " migration_choice
if [[ $migration_choice =~ ^[Nn]$ ]]; then
    run_migrations="0"
fi

setup_ssl="0"
if [ "$ENVIRONMENT" = "production" ]; then
    read -p "Setup SSL certificates? (Y/n): " ssl_choice
    if [[ ! $ssl_choice =~ ^[Nn]$ ]]; then
        setup_ssl="1"
    fi
fi

# Summary
echo ""
echo -e "${PURPLE}Deployment Summary${NC}"
echo "================================"
echo "Environment: $ENVIRONMENT"
if [ "$ENVIRONMENT" = "production" ]; then
    echo "Domain: $domain_name"
    echo "SSL Email: $ssl_email"
    echo "Setup SSL: $([ "$setup_ssl" = "1" ] && echo "Yes" || echo "No")"
fi
echo "Backup before deploy: $([ "$backup_before_deploy" = "1" ] && echo "Yes" || echo "No")"
echo "Run migrations: $([ "$run_migrations" = "1" ] && echo "Yes" || echo "No")"
echo "Redis caching: $(grep -q "REDIS_ENABLED=1" "$ENV_FILE" && echo "Yes" || echo "No")"
echo "Automatic backups: $(grep -q "BACKUP_ENABLED=1" "$ENV_FILE" && echo "Yes" || echo "No")"
if [ "$ENVIRONMENT" = "production" ]; then
    echo "Monitoring: $(grep -q "MONITORING_ENABLED=1" "$ENV_FILE" && echo "Yes" || echo "No")"
fi
echo "================================"
echo ""

# Confirmation
read -p "Proceed with deployment? (Y/n): " proceed
if [[ $proceed =~ ^[Nn]$ ]]; then
    log "Deployment cancelled."
    exit 0
fi

# Make scripts executable
log "Making scripts executable..."
chmod +x docker/scripts/*.sh

# Run deployment
echo ""
log "Starting deployment..."

export ENVIRONMENT="$ENVIRONMENT"
export BACKUP_BEFORE_DEPLOY="$backup_before_deploy"
export RUN_MIGRATIONS="$run_migrations"
export SETUP_SSL="$setup_ssl"

if [ "$ENVIRONMENT" = "production" ]; then
    export DOMAIN_NAME="$domain_name"
fi

# Execute deployment script
if [ -f "docker/scripts/deploy.sh" ]; then
    ./docker/scripts/deploy.sh
else
    error "Deployment script not found!"
    exit 1
fi

# Final message
echo ""
success "🎉 Quick start deployment completed!"
echo ""
echo -e "${PURPLE}Next Steps:${NC}"

if [ "$ENVIRONMENT" = "production" ]; then
    echo "1. Visit your website: https://$domain_name"
    echo "2. Access WordPress admin: https://$domain_name/wp-admin"
    echo "3. Test custom quiz: https://$domain_name/wp-content/themes/twentytwentyfour/quiz-app/"
else
    echo "1. Visit your website: http://localhost"
    echo "2. Access WordPress admin: http://localhost/wp-admin"
    echo "3. Test custom quiz: http://localhost/wp-content/themes/twentytwentyfour/quiz-app/"
fi

echo "4. Monitor logs: docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f"
echo "5. Check deployment documentation: DEPLOYMENT.md"
echo ""
echo -e "${GREEN}Happy coding! 🚀${NC}"