<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.inputcorrect{width:560px; height:30px; font-size:23px; border-color:white;}
.searchbutton{width:43px; height:39px; style="float: left;" ;}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Ghissu </title>
<link href="index2.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="envelope">
<div id="wrapper">
         <div id="header">
               <div id="navarea">
                   <div id="browse"><img src="images/browse.png" /></div>
                   <div id="mybag"><img src="images/mybag.png" /></div>
               </div>
               <div id="signuparea">
                   <div id="loginarea">
                        <div id="loginvia"><p> Login Via</p></div>
                        <div id="loginicons">
                              <?php
// Include the Facebook sdk base file.
require 'facebook.php';

// Create our Application instance
$facebook = new Facebook(array(
   'appId'  => '208887425874271',
  'secret' => '5f37b0b72cb8421849d9e594c168c3d8',
));

// Get User ID if user is logged in
$user = $facebook->getUser();

// Given that this page is redirected after user login,
// We should have the required code/permission to request user details

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
	//Request current users details hopefully he allowed the app <img src="http://vidicorp.org/blog/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley">
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }

}

$loginUrl = $facebook->getLoginUrl(
	array(
		'scope'         => 'email',
	)
);
?>
<?php if ($user) {?>
<a href='<?php echo $facebook->getLogoutUrl(); ?>'>Logout</a><br />
<?php } else { ?>
<a href='<?php echo $loginUrl; ?>'><div id="fb"><img src="images/fb.png" /></div></a>
<?php
}
if ($user ):
	$name = $user_profile['name']; 
	$email = $user_profile['email'];   
        session_start();
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
	$result = mysql_query("SELECT * FROM userinfo WHERE email='$email';",$con);
	$row=mysql_num_rows($result);
	if($row==1)
	{
	$data=mysql_fetch_row($result);
	$_SESSION['name']=$row[1];
	$_SESSION['email']=$row[2];
	session_write_close();
	header("Location: bookinfo.php");
	}
	else
	{
	header("Location: facebooklogintest2.html");
	}

else:
  // If user is not logged in, print out error message
  if(isset($_REQUEST['error'])) {
	if ( $_REQUEST['error_reason'] == 'user_denied') {
		echo "<br />Oops! You have declined to login using Facebook. ";
	}else {
		echo "<br />Oops! Facebook  Error." . $_REQUEST['error_description']  ;
	}
  } 
endif
?>
                              
                        </div>
                        <div id="signup"><p> Sign In/Register </p></div>
                   </div>
                </div>
          </div>
          <div id="mainlogo"><img class="mainlogo" src="images/ghissulogo.PNG" height="300px" width="125" /></div>
          <div id="searcharea">
                   
                          <form  action="search.php" method="GET">
                         <div id="searchbox"> <input style="float: left;"class="inputcorrect" type="text" name="book"><input class="searchbutton" style="float: left;" type="image" src="images/searchbutton.png"></div>
                          </form>
                   </div>
          </div>
          <div id="gap"></div>
</div>

<div id="footer"><p class="footertext"> Click here to know how it works </p></div>
</div>   
</body>
</html>
