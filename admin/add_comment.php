<?php 
require_once("models/config.php");

if (!securePage($_SERVER['PHP_SELF'])){die();}

if(!empty($_POST)){
	$errors = array();
	$franchise_id = trim($_POST["franchise_id"]);	
	$user_id = trim($_POST["user_id"]);	
	$comments = trim($_POST["comments"]);	
	if (addComment($franchise_id, $user_id, $comments))
		echo $comments."<br ><strong>".$loggedInUser->displayname."</strong> [ ".date("j M, Y")." ]";
	else 
		echo "problem in adding comment.";
}
?>