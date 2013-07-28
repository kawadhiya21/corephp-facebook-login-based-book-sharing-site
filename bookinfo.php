<?php
session_start();
if(!isset($_SESSION['email']))
    {header("Location: index.php");
    }
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
$sql="SELECT * FROM submitbook;";
$result1 = mysql_query($sql,$con);
$result=mysql_num_rows($result1);
$sql1="SELECT * FROM userinfo;";
$result2 = mysql_query($sql1,$con);
$result3=mysql_num_rows($result2);
?>

<html>
<head>
<script type='text/javascript'>
function notEmpty(elem, helperMsg){
	if(elem.value.length==0){
		alert(helperMsg);
		
		return false;
	}
	document.getElementById("f").submit();
}
</script>
<style>
.p{width:400px ; height:150px ; border:10px ; border-radius:5 px border-width:5px; margin:40px 0px 0px 300px ;}
.f{text-align:left;}
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29289759-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<h2 style="font-family:verdana;text-align:center;">Register Your Books</h2>
<div class='p' align="right"> 
<form action='submitbook.php' method='POST' id='f'>
<font class='f'>
Name of the Book*:<input type='text' name='bookname' id='req1'></br>
Author:<input type='text' name='author' value=''></br>
<!--//Genre:<input type='text' name='genre' value=''></br>
//About:<input type='text' name='about' value=''></br>-->
Personal views:<input type='text' name='views' value=''></br>
<!--//ISBN:<input type='text' name='isbn' value=''></br>
//Pages:<input type='text' name='page' value=''></br>
//Year of Launch:<input type='year' name='year' value=''></br>
//Level:<input type='level' name='level' value=''></br>-->
Basic Grade Point (out of 10):<input type='text' name='bgp' value=''></br>
</font>
<input type='button' onclick="notEmpty(document.getElementById('req1'), 'Please Enter a Book Name')" value='Submit'></input></br></br>
</t>Total Books Count : <?echo $result;?></br>
</t>Total User Count : <?echo $result3;?></br>
</form>
</br></br><a href='index.php'>Home</a></br><a href='logout.php'>Logout</a>

</br><p>Currently available only for IIT Roorkee Students.</br>
Trading of Books will start from 27th Feb. 00:00:00.</br> Meanwhile, <b>Please register all the books you have</b>. </p>
</br> <b>contact us</b>- +91- 879 120 3443</br>+91-969 077 2367</br>shubham@roorkites.com</br>krnbwj@gmail.com
</div>
</body>
</html>
