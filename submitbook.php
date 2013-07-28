<?php
session_start();
if(!isset($_SESSION['email']))
    {header("Location: index.html");
    }
$name=$_SESSION['name'];
$phone=$_SESSION['phone'];
$email=$_SESSION['email'];
$bookname=$_POST["bookname"];
$author=$_POST["author"];
if($bookname=='')
{die("getlost");
}

$views=$_POST["views"];

$bgp=$_POST["bgp"];
function sanitize($value)
    {
        $value= htmlspecialchars(stripslashes($value));
        $value= str_ireplace("script", "blocked", $value);
        $value = mysql_escape_string($value);
        return $value;
    }
$bookname=sanitize($bookname);
$author=sanitize($author);
$bgp=sanitize($bgp);
$views=sanitize($views);
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
$sql="INSERT INTO submitbook (name, email, phone, bookname, author, views, bgp,time ) VALUES ('$name','$email','$phone','$bookname','$author','$views','$bgp',NOW());";
$result = mysql_query($sql,$con);
  if ($result)
  {echo "Book submitted successfully.<a href='bookinfo.php'>Submit More</a></br></br><a href='logout.php'>Logout</a>";
}
else 
{
 die(mysql_error());
}
?>
