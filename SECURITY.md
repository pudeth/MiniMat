# Security Checklist for Production

## Critical Security Steps

### 1. Environment Configuration
- [ ] Set `APP_ENV=production` in .env
- [ ] Set `APP_DEBUG=false` in .env
- [ ] Generate new `APP_KEY` for production (never reuse local key)
- [ ] Use HTTPS only (redirect HTTP to HTTPS)

### 2. Database Security
- [ ] Use strong database password
- [ ] Create dedicated database user with minimal privileges
- [ ] Never use root database user
- [ ] Enable database firewall rules (allow only app server)
- [ ] Regular database backups

### 3. File Permissions
```bash
# Set proper ownership
chown -R www-data:www-data /path/to/app

# Set directory permissions
find /path/to/app -type d -exec chmod 755 {} \;

# Set file permissions
find /path/to/app -type f -exec chmod 644 {} \;

# Storage and cache need write access
chmod -R 775 storage bootstrap/cache
```

### 4. Sensitive Files Protection
- [ ] Ensure .env is NOT in git repository
- [ ] Ensure .env is NOT accessible via web
- [ ] Keep vendor directory outside public_html if possible
- [ ] Disable directory listing

### 5. API Keys & Tokens
- [ ] Rotate all API keys for production
- [ ] Use environment variables for all secrets
- [ ] Never hardcode credentials in code
- [ ] Secure Bakong API token
- [ ] Secure Telegram bot token
- [ ] Secure Google OAuth credentials

### 6. Web Server Configuration

#### Apache (.htaccess)
```apache
# Disable directory listing
Options -Indexes

# Protect .env file
<Files .env>
    Order allow,deny
    Deny from all
</Files>

# Protect sensitive files
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>
```

#### Nginx
```nginx
# Hide Laravel version
fastcgi_hide_header X-Powered-By;

# Deny access to sensitive files
location ~ /\. {
    deny all;
}

location ~ /\.env {
    deny all;
}
```

### 7. SSL/TLS Configuration
- [ ] Install valid SSL certificate (Let's Encrypt recommended)
- [ ] Force HTTPS redirect
- [ ] Use TLS 1.2 or higher
- [ ] Enable HSTS header

### 8. Application Security
- [ ] Enable CSRF protection (Laravel default)
- [ ] Validate all user inputs
- [ ] Use prepared statements (Laravel Eloquent does this)
- [ ] Sanitize output to prevent XSS
- [ ] Implement rate limiting on login/API routes
- [ ] Use strong password hashing (bcrypt - Laravel default)

### 9. Session Security
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

### 10. Monitoring & Logging
- [ ] Monitor Laravel logs regularly
- [ ] Setup error alerting
- [ ] Log failed login attempts
- [ ] Monitor unusual activity
- [ ] Keep logs secure and rotate them

### 11. Updates & Maintenance
- [ ] Keep Laravel framework updated
- [ ] Update Composer dependencies regularly
- [ ] Update PHP version
- [ ] Apply security patches promptly
- [ ] Review security advisories

### 12. Backup Strategy
- [ ] Daily database backups
- [ ] Weekly full application backups
- [ ] Store backups off-site
- [ ] Test backup restoration regularly

### 13. Additional Hardening
- [ ] Disable unused PHP functions
- [ ] Enable PHP OPcache
- [ ] Disable PHP error display in production
- [ ] Use fail2ban for brute force protection
- [ ] Implement Web Application Firewall (WAF)
- [ ] Regular security audits

## Quick Security Audit Commands

```bash
# Check file permissions
ls -la storage/
ls -la bootstrap/cache/

# Check .env is not accessible
curl https://yourdomain.com/.env

# Check Laravel version
php artisan --version

# Check for outdated packages
composer outdated

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Incident Response Plan

If security breach detected:
1. Enable maintenance mode: `php artisan down`
2. Change all passwords and API keys
3. Review logs for unauthorized access
4. Restore from clean backup if needed
5. Patch vulnerability
6. Notify affected users if required
7. Document incident and lessons learned

## Security Contacts

- Laravel Security: security@laravel.com
- Report vulnerabilities: [your-security-email]

## Compliance

- [ ] GDPR compliance (if applicable)
- [ ] PCI DSS compliance (for payment processing)
- [ ] Local data protection laws
- [ ] Terms of Service and Privacy Policy

## Regular Security Tasks

### Daily
- Monitor error logs
- Check for failed login attempts

### Weekly
- Review access logs
- Check for security updates

### Monthly
- Update dependencies
- Review user permissions
- Test backups

### Quarterly
- Security audit
- Penetration testing
- Review and update security policies
