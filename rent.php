<?php
session_start();
if(!isset($_SESSION['email']))
    {die("Please Login to continue.<a href='index.php'>Home</a>");
    }

$user=$_SESSION['name'];
$contact=$_SESSION['phone'];
$si=$_GET["si"];
function sanitize($value) {
    $value = htmlspecialchars(stripslashes($value));
    $value = str_ireplace("script", "blocked", $value);
    $value = mysql_escape_string($value);
    return $value;
}

$si = sanitize($si);
$mysql_host = "mysql14.000webhost.com";
$mysql_database = "a4002375_ghissu";
$mysql_user = "a4002375_shubham";
$mysql_password = "asdf1234";
$con = mysql_connect("$mysql_host","$mysql_user","$mysql_password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$db = mysql_select_db("$mysql_database", $con);
$sql = "SELECT * FROM submitbook WHERE si='$si' ;";
$result=mysql_query($sql);
$row=mysql_fetch_row($result);
$sql = "INSERT INTO adminorder (ruser , rcontact , rbook,rsi,time) VALUES ('$user' ,'$contact','$row[4]','$si',NOW());";
$result=mysql_query($sql);

if($result)
{
echo "Your request has been recieved and you will be contacted soon.Return Back to <a href='index.php'>Home</a> or <a href='logout.php'>Logout</a>";
}
?>
