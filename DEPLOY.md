# WordPress Docker Deployment Guide - Ubuntu Server

## 📋 Prerequisites
- Ubuntu Server (20.04 or newer)
- Docker and Docker Compose installed
- Domain name pointed to your server IP
- SSH access to your server

## 🚀 Deployment Steps

### 1. Install Docker on Ubuntu Server

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

# Install Docker Compose
sudo apt install docker-compose -y

# Add user to docker group
sudo usermod -aG docker $USER
newgrp docker
```

### 2. Upload WordPress Files

```bash
# Create project directory
mkdir -p ~/wordpress
cd ~/wordpress

# Upload all files from your local wordpress folder to ~/wordpress
# Use SCP, SFTP, or Git
```

### 3. Configure Environment (Optional)

Create `.env` file for custom credentials:

```bash
nano .env
```

Add:
```env
MYSQL_ROOT_PASSWORD=your_strong_root_password
MYSQL_DATABASE=wordpress
MYSQL_USER=wordpress
MYSQL_PASSWORD=your_strong_password
```

### 4. Import Database

```bash
# Start containers
docker-compose up -d

# Wait for MySQL to initialize (30 seconds)
sleep 30

# Import database
docker exec -i wordpress_mysql mysql -uwordpress -ppassword wordpress < database_setup.sql
```

### 5. Start Services

```bash
# Build and start all containers
docker-compose up -d --build

# Check status
docker-compose ps

# View logs
docker-compose logs -f wordpress
```

### 6. Access Your Site

- **WordPress**: http://your-server-ip
- **phpMyAdmin**: http://your-server-ip:8080

### 7. Configure Domain (Optional)

Update WordPress URLs in database:
```bash
docker exec -i wordpress_mysql mysql -uwordpress -ppassword wordpress -e "
UPDATE wp_options SET option_value='http://yourdomain.com' WHERE option_name IN ('siteurl', 'home');
"
```

## 🔧 Management Commands

### Stop containers
```bash
docker-compose down
```

### Restart containers
```bash
docker-compose restart
```

### View logs
```bash
docker-compose logs -f
```

### Backup database
```bash
docker exec wordpress_mysql mysqldump -uwordpress -ppassword wordpress > backup_$(date +%Y%m%d).sql
```

### Update containers
```bash
docker-compose pull
docker-compose up -d
```

## 📁 File Structure

```
/var/www/public_html/  - WordPress files (inside container)
~/wordpress/           - Project root on server
  ├── Dockerfile
  ├── docker-compose.yml
  ├── wp-config.php
  ├── database_setup.sql
  └── (all WordPress files)
```

## 🔒 Security Recommendations

1. **Change database passwords** in `.env` file
2. **Update WordPress salts** in `wp-config.php` - Get from: https://api.wordpress.org/secret-key/1.1/salt/
3. **Setup SSL/HTTPS** using Let's Encrypt
4. **Enable firewall**:
   ```bash
   sudo ufw allow 80
   sudo ufw allow 443
   sudo ufw allow 22
   sudo ufw enable
   ```

## ⚠️ Troubleshooting

### Container won't start
```bash
docker-compose logs wordpress
docker-compose logs db
```

### Database connection error
```bash
# Check if MySQL is ready
docker exec wordpress_mysql mysqladmin -uwordpress -ppassword ping

# Restart containers
docker-compose restart
```

### Permission issues
```bash
docker exec wordpress_app chown -R www-data:www-data /var/www/public_html
```

## 📝 Notes

- WordPress runs on port **80**
- phpMyAdmin runs on port **8080**
- MySQL data persists in Docker volume `wordpress_db`
- All files mounted from current directory to `/var/www/public_html`

## 🎯 Your Qudrat100 Site

This deployment includes:
- Custom Arabic theme
- Quiz system (quiz.php, admin.php, demo.php)
- Course registration
- Database with custom tables

Access admin panel: http://your-domain.com/admin.php (admin/admin123)
