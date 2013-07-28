<?php
session_start();
$key=$_POST['key'];
$password=$_POST['password'];
$key=mysql_escape_string($key);
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
$result = mysql_query("SELECT * FROM userinfo WHERE email='$key' OR phone='$key' AND password='$password';");
$row=mysql_num_rows($result);
if($row==1)
{
$data=mysql_fetch_row($result);
$_SESSION['name']=$data[1];
$_SESSION['email']=$data[2];
$_SESSION['phone']=$data[5];
session_write_close();
header("Location: bookinfo.php");
}
else
{
echo "Sorry wrong credentials";
}
?>

 

