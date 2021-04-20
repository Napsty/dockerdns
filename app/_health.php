<?php 

error_reporting (E_ALL ^ E_NOTICE);

$target=$_ENV['target'] ?: "www.google.com";

$output=exec("./check_dns -H $target", $out, $retval);
// Output should be looking like this:
// DNS OK: 0.027 seconds response time. TARGET returns IP|time=0.026859s;;;0.000000
preg_match('/time=(.*)s/', "$output", $responsetime);

$content="{ \"dockerdns\": { \"message\":\"$output\", \"exitcode\":$retval, \"responsetime\":$responsetime[1] }}\n";

$stdout=fopen("/tmp/application.log", "a+");

if ($retval > 0) {
	header('Content-Type: application/json');
	http_response_code(503);
	echo("$content");
	fwrite($stdout, $content);

} else {
	header('Content-Type: application/json');
	http_response_code(200);
	echo("$content");
	fwrite($stdout, $content);
}

fclose($stdout);

?>
