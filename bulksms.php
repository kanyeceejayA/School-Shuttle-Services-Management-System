<?php

$to = $_GET['to'];
$text = $_GET['text'];

$params = array('mocean-username' => 'kanyeceejay',
 				 'mocean-password' => '1nterNaalya',
 				 'mocean-from' => 'RTL',
 				 'mocean-to' => $to,
 				 'mocean-text' => $text
 				);

$query = http_build_query($params);

//Create HTTP context details
$contextData = array('method' =>'POST' ,
					 'header' => 'Connection: close\r\n'. 'Content-Length: '.strlen($query).'\r\n',
					 'content'=> $query);
//Create context resource for our request
$context = stream_context_create(array('http' =>$contextData ));

//Read page rendered as result of POST request

$result = file_get_contents('http://gps.kirungi.co.ug/send.php', false, $context);

echo $result;
?>