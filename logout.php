<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("admin/models/config.php");

//Log the user out
if(isFranchiseLoggedIn())
{
	$loggedInUser->userLogOut();
}

if(!empty($websiteUrl)) 
{
	header("Location: index.php");
	die();
}
else
{
	header("Location: http://".$_SERVER['HTTP_HOST']);
	die();
}	

?>

