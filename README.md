# WordPress with Custom Quiz System - Docker Deployment

A production-ready WordPress application with a custom quiz system, fully containerized with Docker for easy deployment and scaling.

## 🌟 Features

- **WordPress 6.7.1** with PHP 8.2 and Apache
- **Custom Quiz Application** with interactive questions and scoring
- **Production-ready Docker setup** with SSL, caching, and monitoring
- **Automated deployment scripts** for quick setup
- **Database migration tools** for localhost to production migration
- **SSL certificate automation** with Let's Encrypt
- **Nginx reverse proxy** with security headers
- **Redis caching** for improved performance
- **Automated backups** and monitoring capabilities

## 🚀 Quick Start

### Option 1: Interactive Quick Start (Recommended)

```bash
# Make the quick start script executable
chmod +x quick-start.sh

# Run the interactive setup
./quick-start.sh
```

### Option 2: Manual Deployment

```bash
# 1. Configure environment
cp .env.production .env.production
nano .env.production

# 2. Run deployment
ENVIRONMENT=production ./docker/scripts/deploy.sh
```

## 📋 Prerequisites

- **Docker** 20.10+
- **Docker Compose** 2.0+
- **Domain name** (for production)
- **Server** with 2GB+ RAM and ports 80/443 open

## 🏗️ Architecture

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│     Nginx       │    │   WordPress     │    │     MySQL       │
│  (Reverse Proxy)│◄──►│   (Apache)      │◄──►│   (Database)    │
│   SSL Termination│    │  Custom Quiz    │    │                 │
└─────────────────┘    └─────────────────┘    └─────────────────┘
         │                       │                       │
         ▼                       ▼                       ▼
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Let's Encrypt │    │     Redis       │    │    Backup       │
│  (SSL Certs)    │    │   (Caching)     │    │   (Automated)   │
└─────────────────┘    └─────────────────┘    └─────────────────┘
```

## 📁 Project Structure

```
wordpress/
├── 📁 docker/                      # Docker configuration
│   ├── 📄 apache-config.conf       # Apache production config
│   ├── 📄 nginx.conf               # Nginx reverse proxy config
│   ├── 📄 migrate-to-production.php # Database migration script
│   ├── 📁 mysql-init/              # Database initialization
│   ├── 📁 scripts/                 # Deployment scripts
│   ├── 📁 ssl/                     # SSL certificates
│   └── 📁 certbot/                 # Let's Encrypt data
├── 📁 wp-content/                  # WordPress content
│   ├── 📁 themes/twentytwentyfour/ # WordPress theme
│   │   └── 📁 quiz-app/            # Custom quiz application
│   └── 📁 plugins/                 # WordPress plugins
├── 📄 .env.production              # Production environment
├── 📄 .env.development             # Development environment
├── 📄 .env.staging                 # Staging environment
├── 📄 Dockerfile                   # WordPress container
├── 📄 docker-compose.yml           # Base Docker Compose
├── 📄 docker-compose.prod.yml      # Production overrides
├── 📄 quick-start.sh               # Interactive setup script
├── 📄 DEPLOYMENT.md                # Detailed deployment guide
└── 📄 README.md                    # This file
```

## 🎯 Custom Quiz System

The application includes a fully functional quiz system with:

- **Interactive Questions**: Multiple choice questions with immediate feedback
- **Score Tracking**: Real-time scoring and progress tracking
- **Database Storage**: Questions and sessions stored in MySQL
- **Responsive Design**: Mobile-friendly interface
- **Admin Interface**: WordPress admin integration for quiz management

### Quiz Features

- ✅ Multiple choice questions
- ✅ Real-time scoring
- ✅ Session management
- ✅ Progress tracking
- ✅ Responsive design
- ✅ Database persistence
- ✅ Performance analytics

## 🔧 Configuration

### Environment Variables

Key configuration options in `.env.production`:

```bash
# Domain Configuration
DOMAIN_NAME=qudrat100.com
WORDPRESS_URL=https://qudrat100.com

# Database Configuration
MYSQL_ROOT_PASSWORD=your_secure_password
MYSQL_PASSWORD=your_db_password

# WordPress Security Keys
WORDPRESS_AUTH_KEY=your_auth_key
# ... (generate at https://api.wordpress.org/secret-key/1.1/salt/)

# SSL Configuration
SSL_EMAIL=admin@qudrat100.com

# Optional Features
REDIS_ENABLED=1
BACKUP_ENABLED=1
MONITORING_ENABLED=1
```

### Docker Services

| Service | Description | Port |
|---------|-------------|------|
| `wordpress` | WordPress with Apache | 80 |
| `db` | MySQL 8.0 database | 3306 |
| `nginx` | Reverse proxy with SSL | 443 |
| `redis` | Caching layer | 6379 |
| `certbot` | SSL certificate management | - |
| `backup` | Automated backups | - |
| `prometheus` | Monitoring | 9090 |
| `grafana` | Monitoring dashboard | 3000 |

## 🚀 Deployment Environments

### Development
```bash
# Start development environment
docker-compose up -d

# Access at: http://localhost
```

### Staging
```bash
# Deploy to staging
ENVIRONMENT=staging ./docker/scripts/deploy.sh

# Access at: https://staging.yourdomain.com
```

### Production
```bash
# Deploy to production
ENVIRONMENT=production ./docker/scripts/deploy.sh

# Access at: https://yourdomain.com
```

## 🔒 Security Features

- **SSL/TLS encryption** with Let's Encrypt
- **Security headers** (HSTS, CSP, X-Frame-Options)
- **Rate limiting** for login and API endpoints
- **File upload restrictions** and PHP execution prevention
- **Database access controls** and user permissions
- **WordPress security keys** and salts
- **Firewall-ready configuration**

## 📊 Monitoring & Maintenance

### Health Checks

```bash
# Check all services
docker-compose -f docker-compose.yml -f docker-compose.prod.yml ps

# View logs
docker-compose -f docker-compose.yml -f docker-compose.prod.yml logs -f
```

### Backups

```bash
# Manual database backup
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec db mysqldump -u root -p wordpress_prod > backup.sql

# Restore database
docker-compose -f docker-compose.yml -f docker-compose.prod.yml exec -T db mysql -u root -p wordpress_prod < backup.sql
```

### SSL Certificate Renewal

```bash
# Manual renewal
docker-compose -f docker-compose.yml -f docker-compose.prod.yml run --rm certbot renew

# Automatic renewal (crontab)
0 12 * * * /path/to/project/docker/scripts/renew-ssl.sh
```

## 🛠️ Development

### Local Development Setup

```bash
# Clone repository
git clone <repository-url>
cd wordpress

# Start development environment
docker-compose up -d

# Access WordPress
open http://localhost

# Access phpMyAdmin
open http://localhost:8080
```

### Making Changes

```bash
# Edit WordPress files
# Files are mounted as volumes for live editing

# Rebuild containers after Dockerfile changes
docker-compose build wordpress

# Restart services
docker-compose restart
```

## 🔍 Troubleshooting

### Common Issues

1. **SSL Certificate Issues**
   ```bash
   # Check domain accessibility
   ping yourdomain.com
   
   # Use staging environment for testing
   STAGING=1 ./docker/scripts/setup-ssl.sh
   ```

2. **Database Connection Issues**
   ```bash
   # Check database logs
   docker-compose logs db
   
   # Test connection
   docker-compose exec db mysql -u root -p
   ```

3. **WordPress Issues**
   ```bash
   # Check WordPress logs
   docker-compose logs wordpress
   
   # Access container
   docker-compose exec wordpress bash
   ```

### Performance Optimization

- Enable Redis caching (`REDIS_ENABLED=1`)
- Use CDN for static assets
- Optimize database regularly
- Monitor resource usage
- Enable Gzip compression (included)

## 📚 Documentation

- **[DEPLOYMENT.md](DEPLOYMENT.md)** - Detailed deployment guide
- **[Docker Hub](https://hub.docker.com/_/wordpress)** - WordPress Docker image
- **[WordPress Codex](https://codex.wordpress.org/)** - WordPress documentation
- **[Let's Encrypt](https://letsencrypt.org/)** - SSL certificate documentation

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:

1. Check the [troubleshooting section](#-troubleshooting)
2. Review the [deployment documentation](DEPLOYMENT.md)
3. Check Docker and service logs
4. Create an issue in the repository

## 🎉 Acknowledgments

- WordPress community for the excellent CMS
- Docker team for containerization technology
- Let's Encrypt for free SSL certificates
- Nginx team for the powerful web server
- MySQL team for the reliable database

---

**Ready to deploy?** Run `./quick-start.sh` and follow the interactive setup! 🚀