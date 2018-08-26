# Basic AWS PHP SDK examples

#### Local Install
1. Clone the repo
2. Composer install
3. php artisan serve

#### AWS Install
##### User data for EC2 instance to run a configuration script during launch.

```
#!/bin/bash
yum update -y
yum remove -y httpd
yum install -y httpd24 git php72 php72-gd php72-cli php72-common php72-json php72-intl php72-mbstring php72-pdo php72-xml
service httpd start
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
git clone https://github.com/gvelinov/laravel-aws.git /var/www/html
cd /var/www/html
sudo php /usr/local/bin/composer install
mv .env.example .env
php artisan key:generate
usermod -a -G apache ec2-user
chown -R ec2-user:apache /var/www/html
chmod 2775 /var/www/html
find /var/www/html -type d -exec chmod 2775 {} \;
find /var/www/html -type f -exec chmod 0664 {} \;
```

This script will install Apache 2.4, PHP 7.2, Composer and Git. It also 
gets the src code from this repo.


