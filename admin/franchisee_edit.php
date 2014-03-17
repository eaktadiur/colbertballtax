<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$leadId = $_GET['id'];

//Check if selected lead exists
if(!franchiseIdExists($leadId)){
	header("Location: franchisee.php"); die();
}
$leaddetails = fetchFranchisedetails($leadId); //Fetch lead details

require_once("header.php");



?>

<div>
				<ul class="breadcrumb">
					<li>
						<a href="account.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="leads.php">Edit Franchisee</a>
					</li>
				</ul>
			</div>


        <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Franchisee Details</h2>
						
					</div>
					<div class="box-content">
<?php include('fran_edit.php'); ?>
</div>
				</div><!--/span-->
			
			</div>	
            <?php include('footer.php'); ?>
   </body>
</html>