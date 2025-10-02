# Qudrat100 Docker Development Environment

This Docker setup provides a development environment that closely matches XAMPP for the Qudrat100 quiz application.

## 🚀 Quick Start

### Prerequisites
- Docker Desktop installed and running
- Git Bash (for Windows users)

### Start Development Environment
```bash
cd docker
./start-dev.sh
```

For a fresh start (removes all data):
```bash
./start-dev.sh --fresh
```

## 📋 Services

| Service | URL | Purpose |
|---------|-----|---------|
| WordPress | http://localhost:8080 | Main WordPress site |
| Quiz App | http://localhost:8080/quiz.php | Quiz application |
| Admin Panel | http://localhost:8080/admin.php | Quiz management |
| Demo | http://localhost:8080/demo.php | Demo page |
| phpMyAdmin | http://localhost:8081 | Database management |
| Redis Commander | http://localhost:8082 | Redis management |

## 🔑 Default Credentials

### WordPress
- **Username:** admin
- **Password:** admin123
- **Email:** admin@qudrat100.com

### MySQL
- **Root Password:** root_password
- **Database:** qudrat100_db
- **Username:** qudrat100_user
- **Password:** qudrat100_pass

### Redis
- **Password:** redis_pass

## 📁 Project Structure

```
docker/
├── Dockerfile.wordpress          # Custom WordPress image
├── docker-compose.dev.yml        # Development environment
├── docker-entrypoint.sh          # WordPress initialization script
├── wp-config-docker.php          # WordPress configuration
├── uploads.ini                   # PHP upload settings
├── .env.dev                      # Development environment variables
├── start-dev.sh                  # Startup script
├── mysql-init/                   # Database initialization
│   └── 01-init-quiz-tables.sql   # Quiz tables setup
├── contabo-deployment/           # Contabo server deployment
└── hostinger-deployment/         # Hostinger deployment
```

## 🔧 Development Features

### XAMPP Compatibility
- **PHP 8.1** with all necessary extensions
- **MySQL 8.0** with proper configuration
- **Apache** with mod_rewrite enabled
- **Redis** for caching
- **phpMyAdmin** for database management

### File Synchronization
- Local `wp-content` directory is synced with container
- Quiz application files are automatically copied
- Changes are reflected immediately

### Database Tables
The environment automatically creates:
- `wp_quiz_questions` - Quiz questions storage
- `wp_quiz_results` - User quiz results
- `wp_course_registrations` - Course registration data

## 🛠️ Common Commands

### Start/Stop Services
```bash
# Start development environment
./start-dev.sh

# Stop all services
docker-compose -f docker-compose.dev.yml down

# View logs
docker-compose -f docker-compose.dev.yml logs -f

# View specific service logs
docker-compose -f docker-compose.dev.yml logs -f wordpress
```

### Database Operations
```bash
# Access MySQL CLI
docker-compose -f docker-compose.dev.yml exec mysql mysql -u qudrat100_user -p qudrat100_db

# Backup database
docker-compose -f docker-compose.dev.yml exec mysql mysqldump -u qudrat100_user -p qudrat100_db > backup.sql

# Restore database
docker-compose -f docker-compose.dev.yml exec -T mysql mysql -u qudrat100_user -p qudrat100_db < backup.sql
```

### WordPress CLI
```bash
# Access WordPress CLI
docker-compose -f docker-compose.dev.yml exec wordpress wp --allow-root

# Update WordPress
docker-compose -f docker-compose.dev.yml exec wordpress wp core update --allow-root

# Install plugins
docker-compose -f docker-compose.dev.yml exec wordpress wp plugin install plugin-name --allow-root
```

## 🔄 Environment Configuration

### Development (.env.dev)
- Debug mode enabled
- Local database
- No SSL required
- Relaxed security settings

### Production Deployments
- **Contabo:** `contabo-deployment/`
- **Hostinger:** `hostinger-deployment/`

## 📊 Monitoring

### Container Health
```bash
# Check container status
docker-compose -f docker-compose.dev.yml ps

# Check resource usage
docker stats
```

### Application Logs
- WordPress logs: Available in phpMyAdmin or container logs
- Quiz application: Check browser console and network tab
- Database: MySQL error logs in container

## 🐛 Troubleshooting

### Common Issues

1. **Port conflicts**
   ```bash
   # Check what's using the ports
   netstat -an | findstr :8080
   netstat -an | findstr :3306
   ```

2. **Permission issues**
   ```bash
   # Fix file permissions
   docker-compose -f docker-compose.dev.yml exec wordpress chown -R www-data:www-data /var/www/html
   ```

3. **Database connection issues**
   ```bash
   # Restart MySQL service
   docker-compose -f docker-compose.dev.yml restart mysql
   ```

4. **WordPress not loading**
   ```bash
   # Check WordPress logs
   docker-compose -f docker-compose.dev.yml logs wordpress
   ```

### Reset Environment
```bash
# Complete reset (removes all data)
docker-compose -f docker-compose.dev.yml down -v
docker system prune -f
./start-dev.sh --fresh
```

## 🚀 Deployment

### To Contabo Server
```bash
cd contabo-deployment
./deploy-contabo.sh
```

### To Hostinger
```bash
cd hostinger-deployment
./deploy-hostinger.sh
```

## 📝 Development Notes

### File Changes
- PHP files: Changes reflected immediately
- CSS/JS: May need browser refresh
- Database schema: Requires container restart

### Performance
- Redis caching enabled for better performance
- Optimized MySQL configuration
- Gzip compression enabled

### Security
- Development environment has relaxed security
- Production deployments include proper security headers
- SSL certificates configured for production

## 🤝 Contributing

1. Make changes to your local files
2. Test in development environment
3. Commit changes to Git
4. Deploy to staging/production

## 📞 Support

For issues or questions:
1. Check the troubleshooting section
2. Review container logs
3. Check the main project documentation