<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("admin/models/config.php");
if (!$loggedInUser->user_id){die();}



$leadId = $loggedInUser->user_id;



//Check if selected lead exists
/*if(!leadIdExists($leadId)){
	header("Location: leads.php"); die();
}*/
$leaddetails = fetchFranchisedetails($leadId); //Fetch lead details
include('header.php');
?>


<div class="row-fluid sortable">		
				<div class="box span12">

<iframe src="http://colbertballtax.com/franchise-tools/mediabuy.php" width="100%" frameborder="0" height="1024"></iframe>

</div><!--/span-->
			
			</div>	

<?php include('footer.php'); ?>