# Deployment Guide

## Pre-Deployment Checklist

### 1. Code Preparation
- [x] All features tested locally
- [x] Git repository initialized
- [x] .gitignore configured
- [x] .env.example created
- [ ] Remove debug/test files

### 2. Environment Configuration
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate new `APP_KEY` for production
- [ ] Update `APP_URL` to production domain
- [ ] Configure production database credentials
- [ ] Update Google OAuth redirect URI

### 3. Security
- [ ] Review all API keys and tokens
- [ ] Ensure .env is not in git
- [ ] Set proper file permissions
- [ ] Enable HTTPS/SSL
- [ ] Configure CORS if needed

### 4. Database
- [ ] Create production database
- [ ] Run migrations: `php artisan migrate --force`
- [ ] Seed initial data if needed
- [ ] Backup strategy in place

### 5. Storage & Cache
- [ ] Run `php artisan storage:link`
- [ ] Set storage permissions: `chmod -R 775 storage`
- [ ] Set cache permissions: `chmod -R 775 bootstrap/cache`
- [ ] Clear caches: `php artisan config:cache`, `php artisan route:cache`, `php artisan view:cache`

## Deployment Steps

### Option 1: Shared Hosting (cPanel)

1. **Upload Files**
   ```
   - Upload all files except 'public' folder to root directory (e.g., /home/username/laravel)
   - Upload 'public' folder contents to public_html
   ```

2. **Update index.php**
   Edit `public_html/index.php`:
   ```php
   require __DIR__.'/../laravel/vendor/autoload.php';
   $app = require_once __DIR__.'/../laravel/bootstrap/app.php';
   ```

3. **Create Database**
   - Create MySQL database via cPanel
   - Note database name, username, password

4. **Configure .env**
   - Copy .env.example to .env
   - Update all production values
   - Generate key: `php artisan key:generate`

5. **Run Migrations**
   ```bash
   php artisan migrate --force
   ```

6. **Set Permissions**
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

### Option 2: VPS/Cloud Server (Ubuntu/Nginx)

1. **Install Dependencies**
   ```bash
   sudo apt update
   sudo apt install php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml php8.1-curl
   sudo apt install nginx mysql-server composer
   ```

2. **Clone Repository**
   ```bash
   cd /var/www
   git clone https://github.com/pudeth/MiniMat.git
   cd MiniMat
   ```

3. **Install Composer Dependencies**
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

4. **Configure Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   nano .env  # Edit with production values
   ```

5. **Set Permissions**
   ```bash
   sudo chown -R www-data:www-data /var/www/MiniMat
   sudo chmod -R 775 storage bootstrap/cache
   ```

6. **Configure Nginx**
   Create `/etc/nginx/sites-available/minimat`:
   ```nginx
   server {
       listen 80;
       server_name yourdomain.com;
       root /var/www/MiniMat/public;

       add_header X-Frame-Options "SAMEORIGIN";
       add_header X-Content-Type-Options "nosniff";

       index index.php;

       charset utf-8;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       location = /favicon.ico { access_log off; log_not_found off; }
       location = /robots.txt  { access_log off; log_not_found off; }

       error_page 404 /index.php;

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }

       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

7. **Enable Site**
   ```bash
   sudo ln -s /etc/nginx/sites-available/minimat /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl restart nginx
   ```

8. **Setup SSL (Let's Encrypt)**
   ```bash
   sudo apt install certbot python3-certbot-nginx
   sudo certbot --nginx -d yourdomain.com
   ```

9. **Run Migrations**
   ```bash
   php artisan migrate --force
   ```

10. **Setup Scheduler (Cron)**
    ```bash
    sudo crontab -e
    ```
    Add:
    ```
    * * * * * cd /var/www/MiniMat && php artisan schedule:run >> /dev/null 2>&1
    ```

11. **Optimize Application**
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

## Post-Deployment

### 1. Verification
- [ ] Visit homepage - should load without errors
- [ ] Test login functionality
- [ ] Test Google OAuth
- [ ] Create test sale
- [ ] Verify KHQR payment generation
- [ ] Check Telegram notifications
- [ ] Test admin dashboard

### 2. Monitoring
- [ ] Setup error logging
- [ ] Configure backup schedule
- [ ] Monitor disk space
- [ ] Check Laravel logs: `storage/logs/laravel.log`

### 3. Performance
- [ ] Enable OPcache
- [ ] Configure Redis/Memcached (optional)
- [ ] Setup CDN for assets (optional)
- [ ] Enable Gzip compression

## Troubleshooting

### 500 Internal Server Error
- Check storage permissions
- Check .env configuration
- Review Laravel logs
- Clear caches

### Database Connection Error
- Verify database credentials in .env
- Check database server is running
- Verify database exists

### Google OAuth Not Working
- Update redirect URI in Google Console
- Check HTTPS is enabled
- Verify client ID and secret

### KHQR Payment Issues
- Verify Bakong API token is valid
- Check API URL is correct
- Review Telegram bot configuration

## Rollback Plan

If deployment fails:
```bash
# Restore previous version
git checkout previous-commit-hash

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Restore database backup if needed
mysql -u username -p database_name < backup.sql
```

## Maintenance Mode

Enable during updates:
```bash
php artisan down --secret="your-secret-token"
# Access via: yourdomain.com/your-secret-token

# After updates
php artisan up
```
