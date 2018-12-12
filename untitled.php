
<?php
$request = "";
$request .= urlencode("Mocean-Username") . "=" . urlencode("kanyeceejay") .
"&";
$request .= urlencode("Mocean-Password") . "=" . urlencode("1nterNaa") .
"&";
$request .= urlencode("Mocean-From") . "=" . urlencode("RTL") .
"&";
$request .= urlencode("Mocean-To") . "=" . $_GET['to'] .
"&";
$request .= urlencode("Mocean-Text") . "=" . $_GET['text'];
// Build the header
$host = "sales.rtl.ug";
$script = "/cgi-bin/sendsms";
$request_length = 0;
$method = "POST";
//Now construct the headers.
$header = "$method $script HTTP/1.1\r\n";
$header .= "Host: $host\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-length: " . strlen($request) . "\r\n";
$header .= "Connection: close\r\n\r\n";
print "<pre>";
print ($header);
print "</pre>";
// Open the connection
$port = 8866;
$socket = @fsockopen($host, $port, $errno, $errstr);
if ($socket){
// Send HTTP request
fputs($socket, $header . $request);
// Get the response
while(!feof($socket)){
$output[] = fgets($socket); //get the results
}
fclose($socket);
}
else
die ("connection failed....\r\n");
print "\r\n\r\n";
print "<pre>";
print_r($output);
print "</pre>";
?>