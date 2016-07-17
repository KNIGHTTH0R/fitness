# -*- mode: ruby -*-
# vi: set ft=ruby :

VMname = File.basename(Dir.getwd)

Vagrant.configure(2) do |config|

    config.vm.box = "ubuntu/trusty64"
    config.vm.hostname = "#{VMname}"

    config.vm.network "forwarded_port", guest: 80, host: 8080

    config.vm.synced_folder "./", "/var/www/html"

    config.vm.provider "virtualbox" do |vb|
        vb.name = "#{VMname}"
        vb.memory = 1024
        vb.cpus = 2
    end

    config.vm.define "#{VMname}" do |vb|
    end

    config.vm.provision "shell", privileged: false, inline: <<-SHELL
        sudo apt-get update

        sudo apt-get -y install apache2 php5 php5-mysql
        sudo a2enmod rewrite
        sudo service apache2 restart

        sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
        sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
        sudo apt-get -y install mysql-server

        cat << EOF > ~/.my.cnf
[client]
user=root
password=root
EOF
        chmod 0600 ~/.my.cnf

        sudo cat << EOF | sudo tee /etc/mysql/conf.d/charset.cnf > /dev/null
[client]
default-character-set = utf8mb4

[mysql]
default-character-set = utf8mb4

[mysqld]
character-set-client-handshake = FALSE
character-set-server = utf8mb4
collation-server = utf8mb4_unicode_ci
EOF
        sudo cat << EOF | sudo tee /etc/mysql/conf.d/sqlmode.cnf > /dev/null
[mysqld]
sql_mode = TRADITIONAL
EOF
        sudo service mysql restart

        echo "CREATE DATABASE IF NOT EXISTS dbfitness" | mysql
        mysql dbfitness < /var/www/html/database/structure.sql

        cat << EOF > /var/www/html/config.php
<?php

class Config {

	//core settings
    const BASEURL   = '/';
	const ROOT		= __DIR__;
	const DEBUG		= true;

	//database
	const DB_HOST	= 'localhost';
	const DB_USER	= 'root';
	const DB_PASS	= 'root';
	const DB_NAME	= 'dbfitness';
	const DB_DEBUG	= false;

	//SMTP
    const SMTP_HOST = 'mail.example.com';
    const SMTP_USER = 'user';
    const SMTP_PASS = 'pass';
    const SMTP_SECURE = false;
    const SMTP_PORT = 25;

	//mail
    const MAIL_FROM      = 'mail@example.com';
    const MAIL_FROM_NAME = 'Fitness';
    const MAIL_ADMIN     = 'admin@example.com';

}
EOF

    rm /var/www/html/index.html

    SHELL
end
