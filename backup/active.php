<?php 
require_once("admin/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if(!empty($_POST) && $_POST["id"])
{
	
	if ($_POST['active'] == 0){
		setFranchiseActive($_POST["id"]);
		header("Location: franchisee_edit.php?id=".$_POST["id"]);
	}
	else {
		setFranchiseDeactive($_POST["id"]);
		header("Location: franchisee_edit.php?id=".$_POST["id"]);
	}
}
?>