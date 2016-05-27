#!/usr/bin/env bash

echo "### Install Mariadb"
yum -y install mariadb-server mariadb
#systemctl start mariadb.service
#systemctl enable mariadb.service
#mysql_secure_installation

echo "### Install Apache"
yum -y install httpd
#systemctl start httpd.service
#systemctl enable httpd.service
firewall-cmd --permanent --zone=public --add-service=http
firewall-cmd --permanent --zone=public --add-service=https
firewall-cmd --reload

echo "### Install PHP"
yum -y install php php-gd php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-snmp php-soap curl curl-devel
systemctl restart httpd.service

echo "### Install phpMyAdmin"
yum -y install phpMyAdmin
#vi /etc/httpd/conf.d/phpMyAdmin.conf

echo "### Setup app directory under apache"
mkdir /app
chown vagrant:vagrant /app
mkdir /vagrant/tmp
rsync -va /vagrant/Vendor/cakephp/cakephp/app/tmp/ /vagrant/tmp
chmod -R 777 /vagrant/tmp
chown -R vagrant:vagrant /app
sed -i.bak 's|DocumentRoot "/var/www/html"|DocumentRoot "/app"|' /etc/httpd/conf/httpd.conf
sed -i.bak2 's|<Directory "/var/www">|<Directory "/app">|' /etc/httpd/conf/httpd.conf
#ln -s /vagrant /app
service httpd restart

echo "### Install Composer"
curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
echo "PATH=$PATH:/usr/local/bin" >> ~/.bash_profile
echo "export PATH" >> ~/.bash_profile
. ~/.bash_profile

echo "### Install app dependencies via Composer"
yum -y install php-mcrypt
cd /vagrant; composer install

#echo "## Sync /app directory"
#rsync -va /vagrant/ /app

echo "### Stop Mariadb and Apache"
service mariadb stop
service httpd stop