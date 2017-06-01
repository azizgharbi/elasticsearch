#!/usr/bin/env bash

# LAMP server 

PROJECTFOLDER='elastic'
DOMAINE= 'localhost.elastic.test.com'

sudo yum install -y httpd
sudo systemctl start httpd.service
sudo systemctl enable httpd.service
sudo yum install -y mariadb-server mariadb
sudo systemctl start mariadb
sudo systemctl enable mariadb.service
sudo yum install -y php php-mysql

sudo chmod 777 -R /etc/httpd/logs/

# setup hosts file
VHOST=$(cat <<EOF
NameVirtualHost *:80
<VirtualHost *:80>
  ServerName ${DOMAINE}
  DocumentRoot /var/www/html/${PROJECTFOLDER}
  ErrorLog logs/${PROJECTFOLDER}-error_log
 <Directory "/var/www/html/${PROJECTFOLDER}">
       Options FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
 </Directory>
</VirtualHost>
EOF
)
echo "${VHOST}" >> /etc/httpd/conf/httpd.conf


sed -i 's/enforcing/disable/g' /etc/selinux/config

#upgade to php 7
wget https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
wget http://rpms.remirepo.net/enterprise/remi-release-7.rpm
rpm -Uvh remi-release-7.rpm epel-release-latest-7.noarch.rpm
sudo yum-config-manager --enable remi-php70
sudo yum update -y



# restart apache
sudo systemctl restart httpd.service


#elasticsearch
sudo yum install -y wget
wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-5.4.0.rpm
sha1sum elasticsearch-5.4.0.rpm 
sudo rpm --install elasticsearch-5.4.0.rpm
ps -p 1
sudo chkconfig --add elasticsearch
sudo -i service elasticsearch start
sudo -i service elasticsearch stop
sudo /bin/systemctl daemon-reload
sudo /bin/systemctl enable elasticsearch.service
sudo systemctl start elasticsearch.service

sudo chmod 777 -R /etc/elasticsearch
