# DEPLOYMENT GUIDE
## nPunto Activity Tracker - Complete Setup & Deployment Instructions

---

## Table of Contents
1. [Pre-Deployment Checklist](#pre-deployment-checklist)
2. [Development Environment Setup](#development-environment-setup)
3. [Testing](#testing)
4. [Production Deployment](#production-deployment)
5. [Troubleshooting](#troubleshooting)
6. [Post-Deployment Verification](#post-deployment-verification)

---

## Pre-Deployment Checklist

- [ ] PHP 8.2 or higher installed
- [ ] MySQL 5.7+ installed and running (or SQLite for dev)
- [ ] Composer installed globally
- [ ] Git installed (for version control)
- [ ] Apache or Nginx configured (for production)
- [ ] SSL certificate (for production HTTPS)
- [ ] Backup plan in place

---

## Development Environment Setup

### Quick Start (Recommended)

#### For Windows (Batch Script):
1. Open Command Prompt in the project directory
2. Run: `setup.bat`
3. Follow on-screen instructions

#### For Windows (PowerShell):
1. Open PowerShell as Administrator
2. Run: `Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope Process`
3. Run: `.\setup.ps1`
4. Follow on-screen instructions

### Manual Setup Steps

#### Step 1: Install Dependencies
```bash
cd c:\laragon\www\npunto
composer install
```

#### Step 2: Configure Environment
```bash
# Copy example to actual
copy .env.example .env

# Edit .env with your settings:
# DB_HOST=127.0.0.1
# DB_DATABASE=npunto
# DB_USERNAME=root
# DB_PASSWORD=(your password)
```

#### Step 3: Create Database
Using MySQL Console or phpMyAdmin:
```sql
CREATE DATABASE npunto CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Step 4: Generate Key & Run Migrations
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

#### Step 5: Start Development Server
```bash
php artisan serve
```

Access at: **http://localhost:8000**

---

## Testing

### Verify Installation

```bash
# Check Laravel status
php artisan tinker
>>> exit

# Verify database connection
php artisan db

# Test migrations
php artisan migrate:status

# Clear caches
php artisan cache:clear
php artisan config:clear
```

### Test Login

1. Navigate to http://localhost:8000/login
2. Login with: `admin@npunto.local` / `password`
3. You should see the dashboard

### Test Core Features

- [ ] **Create Activity**: Dashboard → New Activity
- [ ] **Update Activity**: Activities → Select one → Update Status
- [ ] **Daily View**: Daily View → Navigate dates
- [ ] **Reports**: Reports → Apply filters → Export CSV
- [ ] **Handover**: Daily View → View Handover (Pending Items)

---

## Production Deployment

### Option 1: Shared Hosting (cPanel)

1. **Upload Files**
   - Upload all files via FTP to `public_html` directory
   - Keep `.env` outside web root if possible

2. **Configure Database**
   - Create MySQL database in cPanel
   - Update `.env` with credentials

3. **Set Directory Permissions**
   ```bash
   chmod 755 storage/
   chmod 755 bootstrap/cache/
   chmod 644 .env
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate --force
   php artisan db:seed --class=DatabaseSeeder
   ```

5. **Enable HTTPS**
   - Install SSL certificate
   - Update `.env`: `APP_URL=https://yourdomain.com`

### Option 2: VPS/Dedicated Server

1. **Clone Repository**
   ```bash
   git clone <repository-url> /var/www/npunto
   cd /var/www/npunto
   ```

2. **Install Dependencies**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Configure Environment**
   ```bash
   cp .env.example .env
   # Edit .env with production values
   php artisan key:generate
   ```

4. **Setup Database**
   ```bash
   mysql -u root -p < database_backup.sql
   # Or
   php artisan migrate --force
   php artisan db:seed --force
   ```

5. **Configure Web Server**

   **For Apache:**
   ```apache
   <VirtualHost *:80>
       ServerName yourdomain.com
       ServerAdmin admin@yourdomain.com
       
       DocumentRoot /var/www/npunto/public
       
       <Directory /var/www/npunto/public>
           AllowOverride All
           Require all granted
       </Directory>
       
       ErrorLog ${APACHE_LOG_DIR}/npunto_error.log
       CustomLog ${APACHE_LOG_DIR}/npunto_access.log combined
   </VirtualHost>
   ```

   **For Nginx:**
   ```nginx
   server {
       listen 80;
       server_name yourdomain.com;
       root /var/www/npunto/public;

       add_header X-Frame-Options "SAMEORIGIN" always;
       add_header X-Content-Type-Options "nosniff" always;
       add_header X-XSS-Protection "1; mode=block" always;

       index index.php index.html index.htm;

       charset utf-8;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location = /favicon.ico { access_log off; log_not_found off; }
       location = /robots.txt  { access_log off; log_not_found off; }

       error_page 404 /index.php;

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }

       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

6. **Setup SSL (Let's Encrypt)**
   ```bash
   sudo certbot certonly --webroot -w /var/www/npunto/public -d yourdomain.com
   ```

7. **Set Permissions**
   ```bash
   sudo chown -R www-data:www-data /var/www/npunto
   sudo chmod -R 755 /var/www/npunto/storage
   sudo chmod -R 755 /var/www/npunto/bootstrap/cache
   ```

8. **Enable Production Mode**
   Edit `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

9. **Optimize Application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan optimize
   ```

### Option 3: Docker Deployment

Create `Dockerfile`:
```dockerfile
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    mysql-client \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY . .
RUN composer install --no-dev
RUN chown -R www-data:www-data /var/www

EXPOSE 9000
CMD ["php-fpm"]
```

---

## Troubleshooting

### Issue: "No Application Encryption Key"
**Solution:**
```bash
php artisan key:generate
```

### Issue: "Connection refused" to database
**Solution:**
1. Verify MySQL is running (check Laragon or system services)
2. Confirm DB credentials in `.env`
3. Test connection:
   ```bash
   php artisan db
   ```

### Issue: "SQLSTATE[42S02]: Table not found"
**Solution:**
```bash
php artisan migrate
php artisan db:seed
```

### Issue: Permission denied errors
**Solution:**
```bash
# Linux/Mac
sudo chmod -R 755 storage/
sudo chmod -R 755 bootstrap/cache/
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/

# Windows (in admin Command Prompt)
icacls "storage" /grant:r "%USERNAME%:F" /t
icacls "bootstrap\cache" /grant:r "%USERNAME%:F" /t
```

### Issue: Blank page or 500 error
**Solution:**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan optimize:clear

# Check error logs
tail -f storage/logs/laravel.log
```

### Issue: Static files not loading (CSS, JS)
**Solution:**
```bash
php artisan storage:link
# Or verify public directory is correctly configured in web server
```

---

## Post-Deployment Verification

### Security Checks

- [ ] APP_DEBUG is set to `false` in production
- [ ] .env is not accessible via web
- [ ] SSL/HTTPS is enabled
- [ ] Default credentials changed
- [ ] Database password is strong
- [ ] Backups are automated

### Performance Checks

- [ ] Run `php artisan optimize`
- [ ] Enable query caching if available
- [ ] Monitor server resources (CPU, memory, disk)
- [ ] Setup monitoring/alerting

### Functionality Checks

```bash
# Test via cron or scheduler
* * * * * cd /var/www/npunto && php artisan schedule:run >> /dev/null 2>&1

# Test all routes
php artisan route:list

# Check database integrity
php artisan migrate:status
```

### Backup Schedule

Setup automated backups:

```bash
# Daily backup at 2 AM
0 2 * * * /var/www/npunto/backup.sh

# backup.sh sample:
#!/bin/bash
BACKUP_DIR="/backups/npunto"
DATE=$(date +\%Y\%m\%d)
mysqldump -u user -p'password' npunto > $BACKUP_DIR/npunto_$DATE.sql
```

### Monitoring

1. **Error Logs**: Check `storage/logs/laravel.log` regularly
2. **Performance**: Monitor database query times
3. **User Activity**: Review reports regularly
4. **Security**: Check access logs for suspicious activity

---

## Maintenance

### Regular Tasks

```bash
# Weekly
php artisan optimize

# Monthly
php artisan cache:clear
php artisan config:clear
php artisan db:seed  # if needed

# Quarterly
# Review and update dependencies
composer update

# Annually
# Review security settings
# Update SSL certificate if needed
```

### Database Optimization

```sql
-- Check table sizes
SELECT table_name, ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb
FROM information_schema.tables 
WHERE table_schema = 'npunto';

-- Optimize tables
OPTIMIZE TABLE activities;
OPTIMIZE TABLE activity_updates;
OPTIMIZE TABLE users;
```

---

## Support Contacts

- **Development Team**: dev@npunto.local
- **System Admin**: admin@npunto.local
- **Database Admin**: dba@npunto.local

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0.0 | 2026-04-01 | Initial Release |

---

**Last Updated**: April 1, 2026  
**Next Review**: August 1, 2026
