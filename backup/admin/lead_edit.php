<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$leadId = $_GET['id'];

//Check if selected lead exists
/*if(!leadIdExists($leadId)){
	header("Location: leads.php"); die();
}*/
$leaddetails = fetchLeadDetails($leadId); //Fetch lead details

require_once("header.php");


//Forms posted
if(!empty($_POST) && $_POST["id"])
{
	$errors = array();
	$id = trim($_POST["id"]);
	$fname = trim($_POST["fname"]);
	$lname = trim($_POST["lname"]);
	$address = trim($_POST["address"]);
	$city_state_zip = trim($_POST["city_state_zip"]);
	$phone = trim($_POST["phone"]);
	$mobile = trim($_POST["mobile"]);
	$fax = trim($_POST["fax"]);
	$tshirt_size = trim($_POST["t-shirt_size"]);
	$email = trim($_POST["email"]);
	$afname = trim($_POST["afname"]);
	$alname = trim($_POST["alname"]);
	$aemail = trim($_POST["aemail"]);
	$arelation = trim($_POST["arelation"]);
	$aphone = trim($_POST["aphone"]);
	$atshirt_size = trim($_POST["at-shirt_size"]);
	
	
	if($fname == "")
	{
		$errors[] = lang("WEBFORM_SPECIFY_FIRST_NAME");
	}
	if($lname == "")
	{
		$errors[] = lang("WEBFORM_SPECIFY_LAST_NAME");
	}
	if($address == "")
	{
		$errors[] = lang("WEBFORM_SPECIFY_ADDRESS");
	}
	if($city_state_zip == "")
	{
		$errors[] = lang("WEBFORM_SPECIFY_CITY_STATE_ZIP");
	}
	if($phone == "")
	{
		$errors[] = lang("WEBFORM_SPECIFY_PHONE");
	}
	if($email == "")
	{
		$errors[] = lang("WEBFORM_SPECIFY_EMAIL");
	}
	
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}

	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$lead = new leadEdit($id,
							$fname,
							$lname,
							$address,
							$city_state_zip,
							$phone,
							$mobile,
							$fax,
							$tshirt_size,
							$email,
							$afname,
							$alname,
							$aemail,
							$arelation,
							$aphone,
							$atshirt_size,
							$loggedInUser->displayname
							);
		
		
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$lead->modifyLead())
			{
				//if($lead->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($lead->sql_failure)  $errors[] = lang("SQL_ERROR");
				
			}
			
		
	}
	if(count($errors) == 0) {
		$successes[] = $lead->success;
$leaddetails = fetchLeadDetails($leadId);
	}
}


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
                    
                    <?php echo resultBlock($errors,$successes); ?>
                     <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						   <tbody>
                          <tr>
                            <td colspan="4"><strong>Franchisee Owner Information </strong></td>
                            </tr>
                          <tr>
                          	<td>First Name</td>
                            <td><input name="fname" type="text" class="input-xlarge focused" id="fname" value="<?php echo $leaddetails[0]['fname']; ?>" /></td>
                            <td>Last Name</td>
                            <td><input name="lname" type="text" class="input-xlarge focused" id="lname" value="<?php echo $leaddetails[0]['lname']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Mailing Address </td>
                            <td><input name="address" type="text" class="input-xlarge focused" id="address" value="<?php echo $leaddetails[0]['address']; ?>" /></td>
                            <td>City/State/Zip </td>
                            <td><input name="city_state_zip" type="text" class="input-xlarge focused" id="city_state_zip" value="<?php echo $leaddetails[0]['city_state_zip']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Phone </td>
                            <td><input name="phone" type="text" class="input-xlarge focused" id="phone" value="<?php echo $leaddetails[0]['phone']; ?>" /></td>
                            <td>Cell Phone </td>
                            <td><input name="mobile" type="text" class="input-xlarge focused" id="mobile" value="<?php echo $leaddetails[0]['mobile']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Fax </td>
                            <td><input name="fax" type="text" class="input-xlarge focused" id="fax" value="<?php echo $leaddetails[0]['fax']; ?>" /></td>
                            <td>T-Shirt Size </td>
                            <td><input name="t-shirt_size" type="text" class="input-xlarge focused" id="t-shirt_size" value="<?php echo $leaddetails[0]['tshirt_size']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>E-Mail Address: </td>
                            <td><input name="email" type="text" class="input-xlarge focused" id="email" value="<?php echo $leaddetails[0]['email']; ?>" /></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Attendee Information </strong></td>
                            </tr>
                          <tr>
                            <td>First Name </td>
                            <td><input name="afname" type="text" class="input-xlarge focused" id="afname" value="<?php echo $leaddetails[0]['afname']; ?>" /></td>
                            <td>First Name </td>
                            <td><input name="alname" type="text" class="input-xlarge focused" id="alname" value="<?php echo $leaddetails[0]['alname']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>E-Mail Address </td>
                            <td><input name="aemail" type="text" class="input-xlarge focused" id="aemail" value="<?php echo $leaddetails[0]['aemail']; ?>" /></td>
                            <td>Relation </td>
                            <td><input name="arelation" type="text" class="input-xlarge focused" id="arelation" value="<?php echo $leaddetails[0]['arelation']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Phone</td>
                            <td><input name="aphone" type="text" class="input-xlarge focused" id="aphone" value="<?php echo $leaddetails[0]['aphone']; ?>" /></td>
                            <td>T-Shirt Size</td>
                            <td><input name="at-shirt_size" type="text" class="input-xlarge focused" id="at-shirt_size" value="<?php echo $leaddetails[0]['atshirt_size']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>Date Submitted</td>
                            <td><?php echo date("j M, Y", $leaddetails[0]['date']); ?></td>
                            <td></td>
                            <td></td>
                          </tr>
                         
							
                          </tbody>
					  </table>            
                      <p><button type="submit" class="btn btn-primary">Save changes</button></p>
                      <input type="hidden" name="id" value="<?php echo $leaddetails[0]['id']; ?>" />

                      </form>
					</div>
				</div><!--/span-->
			
			</div>	
    
<?php include('footer.php'); ?>
   </body>
</html>