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

<iframe height="862" allowTransparency="true" frameborder="0" scrolling="no" style="width:100%;border:none"  src="https://itforms.wufoo.com/embed/z7p9s9/"><a href="https://itforms.wufoo.com/forms/z7p9s9/">Fill out my Wufoo form!</a></iframe>

</div><!--/span-->
			
			</div>	

<?php include('footer.php'); ?>