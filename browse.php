<!DOCTYPE html>
<html>
   <head>
       <title>Ghissu.com</title>
       <link rel="stylesheet" href="./books.css" />
   </head>
   <body>
       <div id="container">
	   
        <div id="header">
            <div id="logo"><a href='index.php'><img src="images/ghissulogo.PNG"  height="160px" width="70px" align="middle"/></a></div>
            <div id="contact">
                  <div id="context">
                       <div id="text"><p> For Anything, Just CALL </p></div>
                  </div>
                  <div id="contextimg"><img src="images/phonno.png" /></div>
            </div>
            <div id="loginarea">
                 
<?php
$se=$_GET["se"];

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
<a href='<?php echo $facebook->getLogoutUrl(); ?>'></a><br />
<?php } else { ?>
<div id="loginvia">Login Via</div>
                  <div id="loginicons">
<a href='<?php echo $loginUrl; ?>'>
                       <div id="fb"><img src="images/fb.png" /></a></div></div>
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
                       
					   
                  
            </div>
        </div>
		   
           <div class="seperator">
		   </div>
		   
           <div id="navAndSearch">
		       <a href="index.php"><div class="navlinks" >Home</div></a>
		       <a href="howitworks.html"><div class="navlinks" >How it<br/>Works</div></a>
		       <a href="browse.php?se=1"><div class="navlinks" >Browse all<br/>Books</div></a>
			   <div id="searchbox">
			       <form action="search.php" method="GET">
				       <input type="text" name="book" style=" margin:7px 0px 0px 7px; border:0; height:30px; width:570px; padding-left:5px; border-radius:2px;"/>
                                       <input type="hidden" name="se" value="1">
				       <input type="submit" style=" margin:0px 0px 0px 7px; border:0; height:32px; border-radius:2px;"/></form>
					   <div style="color:#ffffff; background-color:#c00; padding:5px 5px 5px 10px; width:260px; margin-left:150px;">
						    <div style="float:left; margin-right:20px;">
						       <input type="radio" name="searchType" id="o1" checked />
						
  	 
	   <label for="o1" style="font-size:14px;" >Title and Author</label>
						    </div>
					        <div style="float:left;">
							    <input type="radio" name="searchType" id="o2" />
								<label for="o2" style="font-size:14px;" >About the book</label>
							</div>
			                <div style="clear:both;"></div>  
					   </div>
				   
			   </div>
			   <div style="clear:both;"></div>
		   </div>
		   
           <div class="seperator">
		   </div>
		   
           <div id="mainContent">
		       <div id="bookDisplay">

<?php

function sanitize($value)
    {
        $value= htmlspecialchars(stripslashes($value));
        $value= str_ireplace("script", "blocked", $value);
        $value = mysql_escape_string($value);
        return $value;
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
$limit=10*($se-1);
$query="SELECT si,bookname,author,bgp,year FROM submitbook LIMIT $limit,10 ;";
$result1 = mysql_query($query, $con);
while($row=mysql_fetch_row($result1))
{
echo "<div class='books' style='float:left; height:124px; width:130px; padding:3px; border:1px solid #f60; margin-right:5px; margin-bottom:5px; font-size:12px;'>
				      <center> <div style=' float:left; width:126px; height:55px; padding:2px; text-align:center; font-size:16px;' >
					      <a href='bookselect.php?si=".$row[0]."'>".ucwords($row[1])."</a>
					   </div>
					   <div style='clear:both;'></div>
					   <div style='width:100px; height:65px; margin-right:15px; background-color:white; float:left; >
					   </div>
					   <div style='width:auto; float:left;'>
					       <div style='width:45px; padding:0; margin:0; margin-bottom:7px;'>Author:".$row[2]."</div>
						   <div style='width:45px; padding:0; margin:0; margin-bottom:7px;'>Rating:".$row[3]."</div>
						   <ul style='list-style-type:disc; margin-left:20px; display:block;'>
						       
						       
						   </ul>
					   </div></center>
					   <div style='clear:both;'></div>
				   </div>";
}
?>
<div style="clear:both;"></div>
				   <div id="booknav" style="float:right; margin-top:15px;">
				      <?if ($se!=1){echo "<a href='browse.php?se=".($se-1)."'><img src='./images/previous.png'></img></a>";
}?>
				       <a href='browse.php?se=<? echo ($se+1);?>'><img src="./images/next.png"></img></a>
				   </div>
			   </div>
			   <div style="clear:both;"></div>
		   </div>
		   
	   </div>
   </body>
</html>
























