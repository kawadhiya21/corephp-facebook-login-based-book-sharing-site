<?php
define('FACEBOOK_APP_ID', '208887425874271');
define('FACEBOOK_SECRET', '5f37b0b72cb8421849d9e594c168c3d8');

function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}

if ($_REQUEST) {
  echo '<p>signed_request contents:</p>';
  $response = parse_signed_request($_REQUEST['signed_request'], 
                                   FACEBOOK_SECRET);

$name = $response["registration"]["name"];
$email = $response["registration"]["email"];
$gender = $response["registration"]["gender"];
$dob = $response["registration"]["birthday"];
$phone = $response["registration"]["phone"];
$bhawan = $response["registration"]["bhawan"];
$room = $response["registration"]["room"];
$password=' ';

$mysql_host = "mysql14.000webhost.com";
$mysql_database = "a4002375_ghissu";
$mysql_user = "a4002375_shubham";
$mysql_password = "asdf1234";
$con = mysql_connect("$mysql_host","$mysql_user","$mysql_password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }


mysql_select_db("$mysql_database", $con);

// Inserting into users table
$result = mysql_query("INSERT INTO userinfo (name, email,gender, dob, phone, bhawan, room, password, time) VALUES ('$name', '$email','$gender', '$dob' , '$phone','$bhawan','$room','$password',NOW())");

if($result){
session_start();
$_SESSION['name']=$name;
$_SESSION['email']=$email;
$_SESSION['phone']=$phone;
session_write_close();
header("Location: bookinfo.php");
}
else
{
echo " Failed . Try Again.";
}
}
else
{
echo '$_REQUEST is empty';
}
?>
