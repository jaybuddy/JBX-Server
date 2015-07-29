#!/bin/sh

echo "Server setup initialized..."

echo "Updating and upgrading initial server software..."
apt-get update
apt-get upgrade
echo "...Done"

echo "Installing additional software..."
echo "php5-dev php5-cgi php5-cli php5-curl php5-gd php5-imagick php5-mcrypt php-apc php5-xmlrpc php5-memcache postfix mailutils vsftpd subversion"
apt-get install php5-dev php5-cgi php5-cli php5-curl php5-gd php5-imagick php5-mcrypt php-apc php5-xmlrpc php5-memcache postfix mailutils vsftpd subversion
echo "...Done"

echo "Creating FTPOnly bucket..."
touch /bin/ftponly
echo 'echo "This account only allows FTP access."' | sudo tee -a /bin/ftponly
chmod a+x /bin/ftponly
echo "/bin/ftponly" | sudo tee -a /etc/shells
echo "...Done"

echo "Adding cron job for log-logins"
echo "* * * * * /usr/bin/php /data/jaybuddy/log/deny.php" | sudo tee -a /var/spool/cron/crontabs/root
echo "...Done"

echo "Create data directory for sites..."
mkdir /data
echo "...Done"

echo "--- Setup Complete ---"

