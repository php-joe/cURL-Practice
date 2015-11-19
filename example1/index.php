<?php
//initialize the session_id
$ch = curl_init();

//set soptions on the session_id

//in this example we just want to load the download.php file
curl_setopt($ch, CURLOPT_URL, "http://localhost/cURL/example1/download.php");

curl_exec($ch);

curl_close($ch);
?>
