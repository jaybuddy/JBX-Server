<?php

$ips = file('/JBX-Server/lib/log-logins/log/deny.log');
file_put_contents('/JBX-Server/lib/log-logins/log/deny.log', '');

if ( is_array($ips) && !empty($ips) ) {
	$unique_ips = array_unique($ips);
	$deny = '';
	foreach ( $unique_ips as $ip ) {
		$i = trim($ip);
		if ( filter_var( $i, FILTER_VALIDATE_IP ) ) {
			$deny .= "deny {$i};\n";
		}
	}

	if ( !empty($deny) ) {
		file_put_contents("/JBX-Server/lib/log-logins/log/blacklist", $deny, FILE_APPEND | LOCK_EX);
		$reload = shell_exec('service nginx reload');

		$log = $deny . "\n" . $reload;
		file_put_contents("/JBX-Server/lib/log-logins/log/cron.log", $log, FILE_APPEND | LOCK_EX);
	}

} else {

	$log = "ping\n";
	file_put_contents("/JBX-Server/lib/log-logins/log/cron.log", $log, FILE_APPEND | LOCK_EX);

}
?>