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
<iframe src="https://docs.google.com/spreadsheet/embeddedform?formkey=dFA5bTdjbUhsUjY3UzdtTjIzcnh5Tnc6MQ" width="100%" height="5975" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>

</div><!--/span-->
			
			</div>	

<?php include('footer.php'); ?>