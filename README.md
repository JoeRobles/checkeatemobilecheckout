Checkeate Mobile Checkout
=========================
1. Install Composer: https://getcomposer.org/download/<br>
2. Run <b>composer install</b><br>
3. Create virtual host:<br>
```
<VirtualHost *:80>
  ServerName local.checkeatemobilecheckout.com
  DirectoryIndex app.php
  DocumentRoot /path/to/checkeate_mobile_checkout/web
  <Directory /path/to/checkeate_mobile_checkout/web>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
```
4. Add <b>127.0.0.1    local.checkeatemobilecheckout.com</b> to <b>/etc/hosts</b><br>
5. Go to <http://local.checkeatemobilecheckout.com>
