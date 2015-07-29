<?php

/**
 *  Plugin Name: Log Logins
 *  Plugin URI: jaybuddy.com
 *  Description: Logs the login attempts of brute force attackers
 *  Author: The Jays
 *  Author URI: jaybuddy.com
 *  version: 1
 *  License: GNU General Public License v2.0
 *  License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if ( $_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['SCRIPT_NAME'] == '/wp-login.php' ) {
	date_default_timezone_set('America/Los_Angeles');

	$kill = false;
	$login = strtolower($_POST['log']);
	$password = strtolower($_POST['pwd']);
	$blacklist = array(
		'admin',
		'administrator',
		'blowjob',
		'internet',
		'12345678'
	);

	$bf_array = array(
		'michy64!',
		'michy64!!',
		'newmichy64!',
		'newmichy64!!'
	);

	if ( $login == 'blufish' && !in_array($password, $bf_array) ) {
		$kill = true;
	}


	if ( in_array($login, $blacklist) || in_array($password, $blacklist) || $kill ) {

		$log = '[' . date('m-d-Y H:i:s') . '] **KILLED** ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_HOST'] . ' ' . json_encode($_POST) . "\n";
		file_put_contents("/JBX-Server/lib/log-logins/log/logins.log", $log, FILE_APPEND | LOCK_EX);

		$ip = $_SERVER['REMOTE_ADDR'] . "\n";
		file_put_contents("/JBX-Server/lib/log-logins/log/deny.log", $ip, FILE_APPEND | LOCK_EX);

		$cflog = $_SERVER['REMOTE_ADDR'] . " Has been added to the ban list.\n";
		file_put_contents("/JBX-Server/lib/log-logins/log/logins.log", $cflog, FILE_APPEND | LOCK_EX);

		die("This is not a valid username or password. If you have any questions, please contact customer service.");

	} else {

		$log = '[' . date('m-d-Y H:i:s') . '] ' . $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['HTTP_HOST'] . ' ' . json_encode($_POST) . "\n";
		file_put_contents("/JBX-Server/lib/log-logins/log/logins.log", $log, FILE_APPEND | LOCK_EX);

	}
}
?>