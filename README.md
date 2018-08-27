# Basic AWS PHP SDK examples

#### What can you do?
_Initial_ 

*Basic S3 file upload* - The home page has file upload form which and on submission
creates bucket in S3 and PUT the file in it.  

#### Local Install
1. Clone the repo
2. Composer install
3. php artisan serve

#### AWS Install

##### EC2 configuration

Select the desire EC2 instance type and don't forget to create and assign a role with S3 permissions
for bucket creation and for creating and object. And a security group allowing HTTP port 80.

##### Use this configuration script in user data for EC2 instance to run during launch.

```
#!/bin/bash
yum update -y
yum remove -y httpd
yum install -y httpd24 git php72 php72-gd php72-cli php72-common php72-json php72-intl php72-mbstring php72-pdo php72-xml
cat > /etc/httpd/conf.d/laravel.conf << EOF
<VirtualHost *:80>
    DocumentRoot "/var/www/html/public"
    Options -Indexes
    DirectoryIndex index.php index.html
    <Directory "/var/www/html/public">
        AllowOverride All
        DirectoryIndex index.php index.html
        Require all granted
    </Directory>
</VirtualHost>
EOF
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
gets the src code from this repo. There is vhost configuration for easier usage.


