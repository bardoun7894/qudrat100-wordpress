#!/bin/bash

# Qudrat100 WordPress Deployment Script for Contabo Server
# Server IP: 184.174.37.148

set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
SERVER_IP="184.174.37.148"
PROJECT_NAME="qudrat100"
BACKUP_DIR="/opt/backups"
LOG_FILE="/var/log/qudrat100-deploy.log"

# Logging function
log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')]${NC} $1" | tee -a "$LOG_FILE"
}

error() {
    echo -e "${RED}[ERROR]${NC} $1" | tee -a "$LOG_FILE"
    exit 1
}

warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1" | tee -a "$LOG_FILE"
}

info() {
    echo -e "${BLUE}[INFO]${NC} $1" | tee -a "$LOG_FILE"
}

# Check if running as root
check_root() {
    if [[ $EUID -ne 0 ]]; then
        error "This script must be run as root"
    fi
}

# Check prerequisites
check_prerequisites() {
    log "Checking prerequisites..."
    
    # Check if Docker is installed
    if ! command -v docker &> /dev/null; then
        error "Docker is not installed. Please install Docker first."
    fi
    
    # Check if Docker Compose is installed
    if ! command -v docker-compose &> /dev/null; then
        error "Docker Compose is not installed. Please install Docker Compose first."
    fi
    
    # Check if .env file exists
    if [[ ! -f ".env" ]]; then
        error ".env file not found. Please create it from .env.example"
    fi
    
    log "Prerequisites check completed successfully"
}

# Create necessary directories
create_directories() {
    log "Creating necessary directories..."
    
    mkdir -p "$BACKUP_DIR"
    mkdir -p "/var/log"
    mkdir -p "./ssl"
    mkdir -p "./wp-content/uploads"
    
    # Set proper permissions
    chmod 755 "$BACKUP_DIR"
    chmod 755 "./ssl"
    chmod 755 "./wp-content/uploads"
    
    log "Directories created successfully"
}

# Backup existing data
backup_existing_data() {
    if docker ps -a | grep -q "${PROJECT_NAME}_"; then
        log "Backing up existing data..."
        
        BACKUP_TIMESTAMP=$(date +%Y%m%d_%H%M%S)
        BACKUP_PATH="${BACKUP_DIR}/backup_${BACKUP_TIMESTAMP}"
        
        mkdir -p "$BACKUP_PATH"
        
        # Backup database
        if docker ps | grep -q "${PROJECT_NAME}_mysql"; then
            docker exec "${PROJECT_NAME}_mysql" mysqldump -u wordpress -p\$DB_PASSWORD wordpress > "${BACKUP_PATH}/database.sql" 2>/dev/null || warning "Database backup failed"
        fi
        
        # Backup wp-content
        if [[ -d "./wp-content" ]]; then
            cp -r "./wp-content" "${BACKUP_PATH}/" || warning "wp-content backup failed"
        fi
        
        log "Backup completed: $BACKUP_PATH"
    else
        info "No existing installation found, skipping backup"
    fi
}

# Copy WordPress content
copy_wordpress_content() {
    log "Copying WordPress content..."
    
    # Copy custom theme
    if [[ -d "../wp-content/themes/custom-theme" ]]; then
        cp -r "../wp-content/themes/custom-theme" "./wp-content/themes/"
        log "Custom theme copied successfully"
    else
        warning "Custom theme not found in ../wp-content/themes/custom-theme"
    fi
    
    # Copy plugins
    if [[ -d "../wp-content/plugins" ]]; then
        cp -r "../wp-content/plugins"/* "./wp-content/plugins/" 2>/dev/null || warning "No plugins to copy"
        log "Plugins copied successfully"
    fi
    
    # Copy quiz application files
    if [[ -f "../quiz.php" ]]; then
        cp "../quiz.php" "./wp-content/"
        log "Quiz application copied successfully"
    fi
    
    if [[ -f "../admin.php" ]]; then
        cp "../admin.php" "./wp-content/"
        log "Admin panel copied successfully"
    fi
    
    # Copy includes and api directories
    if [[ -d "../includes" ]]; then
        cp -r "../includes" "./wp-content/"
        log "Includes directory copied successfully"
    fi
    
    if [[ -d "../api" ]]; then
        cp -r "../api" "./wp-content/"
        log "API directory copied successfully"
    fi
    
    # Copy assets
    if [[ -d "../assets" ]]; then
        cp -r "../assets" "./wp-content/"
        log "Assets directory copied successfully"
    fi
    
    # Set proper permissions
    chown -R www-data:www-data "./wp-content"
    chmod -R 755 "./wp-content"
    
    log "WordPress content copied and permissions set"
}

# Deploy application
deploy_application() {
    log "Deploying application..."
    
    # Pull latest images
    docker-compose pull
    
    # Stop existing containers
    docker-compose down --remove-orphans
    
    # Start database first
    docker-compose up -d db
    log "Database container started"
    
    # Wait for database to be ready
    info "Waiting for database to be ready..."
    sleep 30
    
    # Start WordPress
    docker-compose up -d wordpress
    log "WordPress container started"
    
    # Wait for WordPress to be ready
    info "Waiting for WordPress to be ready..."
    sleep 60
    
    # Start remaining services
    docker-compose up -d
    log "All services started"
}

# Setup SSL certificates
setup_ssl() {
    log "Setting up SSL certificates..."
    
    # Create self-signed certificate for initial setup
    if [[ ! -f "./ssl/privkey.pem" ]]; then
        openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
            -keyout "./ssl/privkey.pem" \
            -out "./ssl/fullchain.pem" \
            -subj "/C=SA/ST=Riyadh/L=Riyadh/O=Qudrat100/CN=${SERVER_IP}"
        
        log "Self-signed SSL certificate created"
    else
        info "SSL certificate already exists"
    fi
}

# Verify deployment
verify_deployment() {
    log "Verifying deployment..."
    
    # Check if containers are running
    if ! docker-compose ps | grep -q "Up"; then
        error "Some containers are not running"
    fi
    
    # Check WordPress accessibility
    sleep 10
    if curl -f -s "http://${SERVER_IP}" > /dev/null; then
        log "WordPress is accessible via HTTP"
    else
        warning "WordPress HTTP check failed"
    fi
    
    # Check database connection
    if docker exec "${PROJECT_NAME}_mysql" mysql -u wordpress -p\$DB_PASSWORD -e "SELECT 1" wordpress &>/dev/null; then
        log "Database connection successful"
    else
        warning "Database connection check failed"
    fi
    
    log "Deployment verification completed"
}

# Cleanup
cleanup() {
    log "Cleaning up..."
    
    # Remove unused Docker images
    docker image prune -f
    
    # Remove old backups (keep last 10)
    if [[ -d "$BACKUP_DIR" ]]; then
        ls -t "$BACKUP_DIR" | tail -n +11 | xargs -r -I {} rm -rf "$BACKUP_DIR/{}"
    fi
    
    log "Cleanup completed"
}

# Main deployment function
main() {
    log "Starting Qudrat100 WordPress deployment for Contabo server..."
    
    check_root
    check_prerequisites
    create_directories
    backup_existing_data
    copy_wordpress_content
    setup_ssl
    deploy_application
    verify_deployment
    cleanup
    
    log "Deployment completed successfully!"
    info "WordPress is now accessible at: http://${SERVER_IP}"
    info "Admin panel: http://${SERVER_IP}/wp-admin"
    info "Quiz application: http://${SERVER_IP}/quiz.php"
    info "Quiz admin: http://${SERVER_IP}/admin.php"
    info "phpMyAdmin: http://${SERVER_IP}:8081"
    
    echo -e "\n${GREEN}=== Deployment Summary ===${NC}"
    echo -e "Server IP: ${BLUE}${SERVER_IP}${NC}"
    echo -e "Project: ${BLUE}${PROJECT_NAME}${NC}"
    echo -e "Log file: ${BLUE}${LOG_FILE}${NC}"
    echo -e "Backup directory: ${BLUE}${BACKUP_DIR}${NC}"
    echo -e "\n${YELLOW}Next steps:${NC}"
    echo -e "1. Complete WordPress setup at http://${SERVER_IP}/wp-admin"
    echo -e "2. Activate the custom-theme"
    echo -e "3. Test the quiz application"
    echo -e "4. Configure SSL certificate if needed"
}

# Run main function
main "$@"