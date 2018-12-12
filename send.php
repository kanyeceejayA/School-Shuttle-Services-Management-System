<?php
include 'dbconnect.php';

$to = $_POST['mocean-to'];
$text=$_POST['mocean-text'];

echo "the message is being sent to: ". $to. "<br>
<br>
the message is ". strlen($text)." characters long. <br>
<br>
the message content is: <br><br>". $text;




?>