# MiniMat POS System

A Laravel-based Point of Sale (POS) system with KHQR payment integration, customer loyalty program, and Telegram notifications.

## Features

- 🛒 Point of Sale interface with product management
- 💳 KHQR (Bakong) payment integration
- 👥 Customer loyalty points system
- 📱 Telegram notifications for sales
- 🔐 Google OAuth authentication
- 👨‍💼 Admin dashboard with sales analytics
- 🏪 Multi-language support (English/Khmer)
- 📊 Sales reporting and tracking

## Requirements

- PHP >= 8.1
- MySQL >= 5.7
- Composer
- Node.js & NPM (optional, for asset compilation)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/pudeth/MiniMat.git
cd MiniMat
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your `.env` file with:
   - Database credentials
   - Bakong KHQR API credentials
   - Telegram bot token and chat ID
   - Google OAuth credentials
   - Merchant information

6. Run migrations:
```bash
php artisan migrate
```

7. Seed database (optional):
```bash
php artisan db:seed
```

8. Create storage symlink:
```bash
php artisan storage:link
```

9. Set proper permissions:
```bash
chmod -R 775 storage bootstrap/cache
```

## Deployment

### Shared Hosting (cPanel)

1. Upload files to your hosting (outside public_html)
2. Move contents of `public` folder to `public_html`
3. Update `public_html/index.php` to point to correct paths
4. Create MySQL database and import migrations
5. Configure `.env` file with production settings
6. Set `APP_ENV=production` and `APP_DEBUG=false`

### VPS/Cloud Server

1. Configure web server (Apache/Nginx) to point to `public` directory
2. Install SSL certificate (Let's Encrypt recommended)
3. Set up cron job for Laravel scheduler:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Configuration

### Environment Variables

Key variables to configure:

- `APP_URL`: Your production domain
- `DB_*`: Database credentials
- `BAKONG_TOKEN`: Your Bakong API token
- `TELEGRAM_BOT_TOKEN`: Telegram bot token
- `GOOGLE_CLIENT_ID` & `GOOGLE_CLIENT_SECRET`: OAuth credentials

### First Admin User

Create admin user via tinker:
```bash
php artisan tinker
```
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@example.com';
$user->password = bcrypt('password');
$user->role = 'admin';
$user->save();
```

## Security Checklist

- ✅ Set `APP_DEBUG=false` in production
- ✅ Set `APP_ENV=production`
- ✅ Use strong `APP_KEY`
- ✅ Secure database credentials
- ✅ Enable HTTPS/SSL
- ✅ Set proper file permissions (755 for directories, 644 for files)
- ✅ Keep `.env` file secure (never commit to git)

## License

This project is proprietary software.

## Support

For support, contact: [your-email@example.com]
