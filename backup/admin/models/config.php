<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/
require_once("db-settings.php"); //Require DB connection
DEFINE("BACK_ROOT","/app/admin/");


//Retrieve settings
$stmt = $mysqli->prepare("SELECT id, name, value
	FROM ".$db_table_prefix."configuration");	
$stmt->execute();
$stmt->bind_result($id, $name, $value);

while ($stmt->fetch()){
	$settings[$name] = array('id' => $id, 'name' => $name, 'value' => $value);
}
$stmt->close();

//Set Settings
$emailActivation = $settings['activation']['value'];
$mail_templates_dir = $_SERVER['DOCUMENT_ROOT'].BACK_ROOT."models/mail-templates/";
$file_upload_dir = $_SERVER['DOCUMENT_ROOT'].BACK_ROOT."upload/";
$websiteName = $settings['website_name']['value'];
$websiteUrl = $settings['website_url']['value'];
$emailAddress = $settings['email']['value'];
$resend_activation_threshold = $settings['resend_activation_threshold']['value'];
$emailDate = date('dmy');
$language = $settings['language']['value'];
$template = $settings['template']['value'];

$master_account = -1;

$default_hooks = array("#WEBSITENAME#","#WEBSITEURL#","#DATE#");
$default_replace = array($websiteName,$websiteUrl,$emailDate);

if (!file_exists($language)) {
	$language = $_SERVER['DOCUMENT_ROOT'].BACK_ROOT."models/languages/en.php";
}

if(!isset($language)) $language = $_SERVER['DOCUMENT_ROOT'].BACK_ROOT."models/languages/en.php";

//Pages to require
require_once($language);
require_once("class.mail.php");
require_once("class.user.php");
require_once("class.newuser.php");
require_once("class.webform.php");
require_once("class.webform.edit.php");
require_once("class.franchise.php");
require_once("class.franchise.edit.php");
require_once("funcs.php");

session_start();

//Global User Object Var
//loggedInUser can be used globally if constructed
if(isset($_SESSION["userCakeUser"]) && is_object($_SESSION["userCakeUser"]))
{
	$loggedInUser = $_SESSION["userCakeUser"];
}

?>
