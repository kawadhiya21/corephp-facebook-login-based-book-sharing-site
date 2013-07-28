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
<a href='<?php echo $loginUrl; ?>'><img src='http://vidicorp.org/images/fblogin.png' width='149' height='22' alt='Login With Facebook' /></a><br />

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

	/*echo "<br /><br /> Full User Profile <br />" ;
	print_r($user_profile) ;
	echo "<br /><br />Available Permission <br />" ;
	$user_permissions = $facebook->api('/me/permissions');
	print_r($user_permissions) ;
	echo "<br /><br />User Notes (if shared) <br />" ;
	$user_permissions = $facebook->api('/me/notes');
	print_r($user_permissions) ;
    // Set up User session and redirect to appropriate home page ;
    //$logoutGoTo = "/profilespage";
    //header("Location: $logoutGoTo");
    //exit;*/
else:
  // If user is not logged in, print out error message
  if(isset($_REQUEST['error'])) {
	if ( $_REQUEST['error_reason'] == 'user_denied') {
		echo "<br />Oops! You have declined to login using Facebook. ";
	}else {
		echo "<br />Oops! Facebook  Error." . $_REQUEST['error_description']  ;
	}
  } else {
	  echo "<br />You are not Logged in" ;
  }
endif
?>

