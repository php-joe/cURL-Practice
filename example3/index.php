<?php
//data will be in form of an array
$data = array("name"=>"Joe", "age"=>38);

//url encode it to string the post it to database
$string = http_build_query($data);
echo $string;


//initialze session
$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, "data.php");
//set options to this handler  use post method to post data to server not browser
curl_setopt($ch, CURLOPT_POST, true);

//curl_setopt($ch, CURLOPT_CONNECTIONTIMEOUT, CS_REST_SOCKET_TIMEOUT);
//curl_setopt($ch, CURLOPT_TIMEOUT, CS_REST_CALL_TIMEOUT);
// doesn't work with this vesrion of php
curl_setopt($ch, CUTLOPT_POSTFIELDS, $string);
//transfer is going to be the return variable of this curl function
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);

//turns out it wasn't cURL cc_class.php that needed updated
 ?>
