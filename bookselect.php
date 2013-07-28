<?php
$si = $_GET["si"];

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
$row=mysql_fetch_array($result);
?>
<html>
<body>
The book details are :</br>
Book Name : <? echo $row[4];?></br>
Author : <? echo $row[5];?></br>
Views : <? echo $row[8];?></br>
Rating : <? echo $row[13];?></br>
</br>
<a href='rent.php?si=<?echo $si;?>'>Rent Here !!!</a>
</body>
</html>


