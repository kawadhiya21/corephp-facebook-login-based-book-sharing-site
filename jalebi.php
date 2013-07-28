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
<link href="firstpagecss.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="bodyCenter">
<div id="top">
                  <div id="browse">
			   <a href='browse.php?se=1'><img src="images/browse.png" /></a>
		  </div>
                   
                   <div id="signuparea">
                   
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
<?php } else { ?>
     <div id="loginvia"><p> Login Via</p>
	 </div>

     <div id="loginicons">
	 <div id="fb" ><a href='<?php echo $loginUrl; ?>'><img src="images/fb.png" style="margin:0px 0px 0px 25px;" /></a>
	 </div>
     </div>
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
	$_SESSION['name']=$data[1];
	$_SESSION['email']=$data[2];
        $_SESSION['phone']=$data[5];
	echo "<font size='4px'> <font color='blue'>Welcome:</font> $data[1]</font> </br><input type='button' value='Submit Books' onclick=location.href='bookinfo.php'></br><input type='button' value='Logout' onclick=location.href='logout.php'>";
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
                              
                </div>      <!--End of SignUpArea -->
          </div>    <!--End of Top -->
<div id="maincenter">
    <div id="maincenter_right">
	 <div id="maincenter_center">
	 <div id="mainlogo">
		     <OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"

WIDTH="450"

HEIGHT="300"

CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=5,0,0,0">

<PARAM NAME="MOVIE" VALUE="raghav.swf">

<PARAM NAME="PLAY" VALUE="true">

<PARAM NAME="LOOP" VALUE="true">

<PARAM NAME="QUALITY" VALUE="high">

<PARAM NAME="SCALE" value="noborder">

<EMBED SRC="raghav.swf"

WIDTH="450"

HEIGHT="300"

PLAY="true" 

LOOP="true"

QUALITY="high" 

scale="noborder"

PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"> 

</EMBED>

</OBJECT>  
	  </div> <!--End of mainlogo -->
	  
	 </div>
          <div id="searcharea">
                   
                          <form  action="search.php" method="GET">
                          <input type='hidden' name='se' value='1'>
                         <div id="searchbox"> <input style="float: left;"class="inputcorrect" type="text" name="book"><input class="searchbutton" style="float: left;" type="image" src="images/searchbutton.png">
			 </div>
                          </form>
           </div>
      </div> <!--End of maincenter_right -->

</div>  <!--End of maincenter -->
<!--          <div id="gap">
	  </div>
-->
<div id="footer">
	 <div id="footertext" class="linkwhite"> 
		  <a href='howitworks.html'>Click here to know how it works</a>
	 </div>  
</div>
</div>
<div id="footnote">
</div>
</body>
</html>
