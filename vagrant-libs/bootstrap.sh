#!/usr/bin/env bash

echo "### Update system packages"
yum -y update

echo "### Install EPEL"
yum -y install epel-release
yum repolist

echo "### Install wget"
yum install -y wget

echo "### Install Docker Compose"
curl -L https://github.com/docker/compose/releases/download/1.6.2/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
chmod a+x /usr/local/bin/docker-compose

echo "### Setup yum repo for Docker Engine"
tee /etc/yum.repos.d/docker.repo <<-'EOF'
[dockerrepo]
name=Docker Repository
baseurl=https://yum.dockerproject.org/repo/main/centos/$releasever/
enabled=1
gpgcheck=1
gpgkey=https://yum.dockerproject.org/gpg
EOF

echo "### Install Docker Engine"
yum install -y docker-engine

echo "### Enable Docker Engine service"
chkconfig docker on

echo "### Start Docker Engine service"
service docker start

echo "### Add vagrant user to docker group"
usermod -aG docker vagrant

echo "### Install Mariadb"
yum -y install mariadb-server mariadb
systemctl start mariadb.service
systemctl enable mariadb.service
#mysql_secure_installation

echo "### Install Apache"
yum -y install httpd
systemctl start httpd.service
systemctl enable httpd.service
firewall-cmd --permanent --zone=public --add-service=http
firewall-cmd --permanent --zone=public --add-service=https
firewall-cmd --reload

echo "### Install PHP"
yum -y install php
systemctl restart httpd.service
yum -y install php-gd php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-snmp php-soap curl curl-devel
systemctl restart httpd.service

echo "### Install phpMyAdmin"
yum -y install phpMyAdmin
#vi /etc/httpd/conf.d/phpMyAdmin.conf

echo "### Setup app directory under apache"
sed -i.bak 's|DocumentRoot "/var/www/html"|DocumentRoot "/app"|' /etc/httpd/conf/httpd.conf
sed -i.bak2 's|<Directory "/var/www">|<Directory "/app">|' /etc/httpd/conf/httpd.conf
ln -s /vagrant /app
service httpd restart

echo "### Install Composer"
curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
echo "PATH=$PATH:/usr/local/bin" >> ~/.bash_profile
echo "export PATH" >> ~/.bash_profile
. ~/.bash_profile

echo "### Install app dependencies via Composer"
yum -y install php-mcrypt
cd /vagrant; composer install

echo "### Stop Mariadb and Apache"
service mariadb stop
service httpd stop