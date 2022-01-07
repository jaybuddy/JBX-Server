# JBX-Server
This repo contains source files for running shared hosting on a LEMP stack. The code is 7 years old so dont use it. 😂


## Instructions

1) Create droplet on Digital Ocean (LEMP on 14.04)
	-Enable Backups

2) SSH into server as root.

2) Install git

`apt-get install git`

3) Clone server base

`git clone https://github.com/jaybuddy/JBX-Server.git`

4) Fire server config script 

`./JBX-Server/src/config.sh`

5) Config MySql Production (You will need the root password that displays on home screen when you login to server.)

`mysql_secure_installation`


## Usage

Adding new website

* `./JBX-Server/bin/add_user <user> <password>`
* `./JBX-Server/bin/add_wp_domain <account> <domain> <port> <password>`


## Description

### /bin
Bin folder containes executable scripts for adding and removing users and domains

### /lib
Includes contains files included in the domain.com.conf files

 * blockbots - Blocks Bots
 * cloudflare - Allows the origional IP address to pass through cloudflare
 * drop - Keeps certain requests out of log files 
 * home - directives for the "/" location within the server block
 * php_params - FASTCGI params
 * static - caching static assets
 * **log-logins** - files & scripts for log logins plugin in mu-plugins
 * **mu-plugins** - plugins included on all WP sites
	* log-logins.php

### /src
config.sh

* Updates Ubuntu
* Installs the following, php5-cli, php5-curl, php5-gd, php5-imagick, php5-mcrypt, php-apc, php5-xmlrp, php5-memcache, postfix, mailutils, vsftpd, subversion
* Adds ftponly bucket
* creates /data directory


