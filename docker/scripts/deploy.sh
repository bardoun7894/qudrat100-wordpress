#!/bin/bash

# WordPress Docker Production Deployment Script
# This script deploys the WordPress application with custom quiz system to production

set -e

# Configuration
ENVIRONMENT=${ENVIRONMENT:-"production"}
DOMAIN_NAME=${DOMAIN_NAME:-"qudrat100.com"}
BACKUP_BEFORE_DEPLOY=${BACKUP_BEFORE_DEPLOY:-1}
RUN_MIGRATIONS=${RUN_MIGRATIONS:-1}
SETUP_SSL=${SETUP_SSL:-1}

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Logging function
log() {
    echo -e "${BLUE}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1"
}

error() {
    echo -e "${RED}[ERROR]${NC} $1" >&2
}

success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

# Check prerequisites
check_prerequisites() {
    log "Checking prerequisites..."
    
    # Check if Docker is installed
    if ! command -v docker &> /dev/null; then
        error "Docker is not installed. Please install Docker first."
        exit 1
    fi
    
    # Check if Docker Compose is installed
    if ! command -v docker-compose &> /dev/null; then
        error "Docker Compose is not installed. Please install Docker Compose first."
        exit 1
    fi
    
    # Check if environment file exists
    if [ ! -f ".env.$ENVIRONMENT" ]; then
        error "Environment file .env.$ENVIRONMENT not found!"
        error "Please copy and configure .env.$ENVIRONMENT from the template."
        exit 1
    fi
    
    # Check if domain is accessible (for SSL)
    if [ "$SETUP_SSL" = "1" ] && [ "$ENVIRONMENT" = "production" ]; then
        if ! ping -c 1 "$DOMAIN_NAME" &> /dev/null; then
            warning "Domain $DOMAIN_NAME is not accessible. SSL setup may fail."
            read -p "Continue anyway? (y/N): " -n 1 -r
            echo
            if [[ ! $REPLY =~ ^[Yy]$ ]]; then
                exit 1
            fi
        fi
    fi
    
    success "Prerequisites check passed!"
}

# Backup existing data
backup_data() {
    if [ "$BACKUP_BEFORE_DEPLOY" = "1" ]; then
        log "Creating backup before deployment..."
        
        BACKUP_DIR="backups/$(date +'%Y%m%d_%H%M%S')"
        mkdir -p "$BACKUP_DIR"
        
        # Backup database if container exists
        if docker-compose ps | grep -q "db"; then
            log "Backing up database..."
            docker-compose exec -T db mysqldump -u root -p"${MYSQL_ROOT_PASSWORD}" wordpress_prod > "$BACKUP_DIR/database.sql" 2>/dev/null || true
        fi
        
        # Backup WordPress files if they exist
        if [ -d "wordpress_data" ]; then
            log "Backing up WordPress files..."
            tar -czf "$BACKUP_DIR/wordpress_files.tar.gz" wordpress_data/ 2>/dev/null || true
        fi
        
        success "Backup created in $BACKUP_DIR"
    fi
}

# Deploy application
deploy_application() {
    log "Starting deployment for $ENVIRONMENT environment..."
    
    # Load environment variables
    export $(cat .env.$ENVIRONMENT | grep -v '^#' | xargs)
    
    # Pull latest images
    log "Pulling latest Docker images..."
    docker-compose -f docker-compose.yml -f docker-compose.prod.yml pull
    
    # Build custom images
    log "Building custom WordPress image..."
    docker-compose -f docker-compose.yml -f docker-compose.prod.yml build wordpress
    
    # Start database first
    log "Starting database..."
    docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d db
    
    # Wait for database to be ready
    log "Waiting for database to be ready..."
    timeout=60
    while ! docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec -T db mysqladmin ping -h"localhost" --silent; do
        timeout=$((timeout - 1))
        if [ $timeout -eq 0 ]; then
            error "Database failed to start within 60 seconds"
            exit 1
        fi
        sleep 1
    done
    
    success "Database is ready!"
    
    # Start WordPress
    log "Starting WordPress..."
    docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d wordpress
    
    # Wait for WordPress to be ready
    log "Waiting for WordPress to be ready..."
    timeout=120
    while ! curl -f http://localhost:${WORDPRESS_PORT:-80}/wp-admin/install.php &> /dev/null; do
        timeout=$((timeout - 1))
        if [ $timeout -eq 0 ]; then
            error "WordPress failed to start within 120 seconds"
            exit 1
        fi
        sleep 1
    done
    
    success "WordPress is ready!"
}

# Run database migrations
run_migrations() {
    if [ "$RUN_MIGRATIONS" = "1" ]; then
        log "Running database migrations..."
        
        # Copy migration script to container
        docker cp docker/migrate-to-production.php $(docker-compose -f docker-compose.yml -f docker-compose.prod.yml ps -q wordpress):/var/www/html/
        
        # Run migration script
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec -T wordpress php migrate-to-production.php
        
        # Remove migration script from container
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec -T wordpress rm -f /var/www/html/migrate-to-production.php
        
        success "Database migrations completed!"
    fi
}

# Setup SSL certificates
setup_ssl() {
    if [ "$SETUP_SSL" = "1" ] && [ "$ENVIRONMENT" = "production" ]; then
        log "Setting up SSL certificates..."
        
        # Make SSL setup script executable
        chmod +x docker/scripts/setup-ssl.sh
        
        # Run SSL setup
        ./docker/scripts/setup-ssl.sh
        
        success "SSL setup completed!"
    fi
}

# Start additional services
start_additional_services() {
    log "Starting additional services..."
    
    # Start nginx (if SSL is configured)
    if [ "$SETUP_SSL" = "1" ] && [ "$ENVIRONMENT" = "production" ]; then
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d nginx
    fi
    
    # Start Redis (if enabled)
    if [ "${REDIS_ENABLED:-0}" = "1" ]; then
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d redis
    fi
    
    # Start backup service (if enabled)
    if [ "${BACKUP_ENABLED:-0}" = "1" ]; then
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d backup
    fi
    
    # Start monitoring (if enabled)
    if [ "${MONITORING_ENABLED:-0}" = "1" ]; then
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d prometheus grafana
    fi
    
    success "Additional services started!"
}

# Verify deployment
verify_deployment() {
    log "Verifying deployment..."
    
    # Check if all services are running
    if ! docker-compose -f docker-compose.yml -f docker-compose.prod.yml ps | grep -q "Up"; then
        error "Some services are not running!"
        docker-compose -f docker-compose.yml -f docker-compose.prod.yml ps
        exit 1
    fi
    
    # Test WordPress accessibility
    if [ "$SETUP_SSL" = "1" ] && [ "$ENVIRONMENT" = "production" ]; then
        TEST_URL="https://$DOMAIN_NAME"
    else
        TEST_URL="http://localhost:${WORDPRESS_PORT:-80}"
    fi
    
    log "Testing WordPress accessibility at $TEST_URL..."
    if curl -f "$TEST_URL" &> /dev/null; then
        success "WordPress is accessible!"
    else
        warning "WordPress accessibility test failed. Please check manually."
    fi
    
    # Test custom quiz functionality
    log "Testing custom quiz functionality..."
    if curl -f "$TEST_URL/wp-content/themes/twentytwentyfour/quiz-app/" &> /dev/null; then
        success "Custom quiz application is accessible!"
    else
        warning "Custom quiz application test failed. Please check manually."
    fi
    
    success "Deployment verification completed!"
}

# Cleanup function
cleanup() {
    log "Cleaning up..."
    
    # Remove unused Docker images
    docker image prune -f
    
    # Remove unused volumes (be careful with this)
    # docker volume prune -f
    
    success "Cleanup completed!"
}

# Main deployment function
main() {
    echo "======================================"
    echo "WordPress Docker Production Deployment"
    echo "======================================"
    echo "Environment: $ENVIRONMENT"
    echo "Domain: $DOMAIN_NAME"
    echo "Backup before deploy: $BACKUP_BEFORE_DEPLOY"
    echo "Run migrations: $RUN_MIGRATIONS"
    echo "Setup SSL: $SETUP_SSL"
    echo "======================================"
    echo
    
    # Confirm deployment
    if [ "$ENVIRONMENT" = "production" ]; then
        warning "You are about to deploy to PRODUCTION!"
        read -p "Are you sure you want to continue? (y/N): " -n 1 -r
        echo
        if [[ ! $REPLY =~ ^[Yy]$ ]]; then
            log "Deployment cancelled."
            exit 0
        fi
    fi
    
    # Run deployment steps
    check_prerequisites
    backup_data
    deploy_application
    run_migrations
    setup_ssl
    start_additional_services
    verify_deployment
    cleanup
    
    echo
    success "🎉 Deployment completed successfully!"
    echo
    echo "Next steps:"
    echo "1. Test your website: $TEST_URL"
    echo "2. Login to WordPress admin: $TEST_URL/wp-admin"
    echo "3. Test the custom quiz: $TEST_URL/wp-content/themes/twentytwentyfour/quiz-app/"
    echo "4. Monitor logs: docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f"
    echo "5. Set up monitoring and backups if not already configured"
    echo
}

# Handle script interruption
trap 'error "Deployment interrupted!"; exit 1' INT TERM

# Run main function
main "$@"