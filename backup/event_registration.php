<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("admin/models/config.php");


//Forms posted
if(!empty($_POST))
{
	$errors = array();
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
	$event_date = trim($_POST["event_date"]);
	$captcha = md5($_POST["captcha"]);
	
	if ($captcha != $_SESSION['captcha'])
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}
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
	if(leadExists($email))
			{
				$errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));
			}
	
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}

	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$lead = new lead($fname,
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
							$event_date
							);
		
		
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$lead->AddLead())
			{
				//if($lead->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($lead->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		
	}
	if(count($errors) == 0) {
		$successes[] = $lead->success;
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Colbert/Ball Tax Services</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-redy.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>



	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
    <style>
	.row-fluid .span8{
		
		display: block;
		float: none;
		width: 900px;
		min-height: 28px;
		margin-left: 2.564102564%;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-ms-box-sizing: border-box;
		box-sizing: border-box;
		margin:auto;}
	</style>
</head>

<body>
<div class="container-fluid" >

		<div class="row-fluid">
		
			
			<noscript>
				<div class="alert alert-block span8">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span8">
			<p><img src="images/cb.jpg" alt="2013 New Franchise Training Registration Form" /></p>
			<?php echo resultBlock($errors,$successes); ?>
			<div class="row-fluid sortable">
				<div class="box span12">
                <?php if(count($successes) == 0) {?>
                <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Franchisee Owner Information</h2>
					</div>
					<div class="box-content">
						
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="alname">First Name</label>
								<div class="controls">
								  <input name="fname" type="text" class="input-xlarge" id="fname" value="<?php echo $fname ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Last Name</label>
								<div class="controls">
								  <input name="lname" type="text" class="input-xlarge" id="lname" value="<?php echo $lname ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Mailing Address</label>
								<div class="controls">
								  <input name="address" type="text" class="input-xlarge" id="address" value="<?php echo $address ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">City/State/Zip</label>
								<div class="controls">
								  <input name="city_state_zip" type="text" class="input-xlarge" id="city_state_zip" value="<?php echo $city_state_zip ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Phone</label>
								<div class="controls">
								  <input name="phone" type="text" class="input-xlarge" id="phone" value="<?php echo $phone ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Cell Phone</label>
								<div class="controls">
								  <input name="mobile" type="text" class="input-xlarge" id="mobile" value="<?php echo $mobile ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Fax</label>
								<div class="controls">
								  <input name="fax" type="text" class="input-xlarge" id="fax" value="<?php echo $fax ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">T-Shirt Size</label>
								<div class="controls">
								  <input name="t-shirt_size" type="text" class="input-xlarge" id="t-shirt_size" value="<?php echo $tshirt_size ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">E-Mail Address: </label>
								<div class="controls">
								  <input name="email" type="text" class="input-xlarge" id="email" value="<?php echo $email ?>">
								</div>
							  </div>
							  
							  
						
							</fieldset>
						
					
					</div>
                    
                    
                    
                    <div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Attendee Information</h2>
					</div>
					<div class="box-content">
						
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="alname">First Name</label>
								<div class="controls">
								  <input name="afname" type="text" class="input-xlarge" id="afname" value="<?php echo $afname ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Last Name</label>
								<div class="controls">
								  <input name="alname" type="text" class="input-xlarge" id="alname" value="<?php echo $alname ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">E-Mail Address</label>
								<div class="controls">
								  <input name="aemail" type="text" class="input-xlarge" id="aemail" value="<?php echo $aemail ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Relation</label>
								<div class="controls">
								  <input name="arelation" type="text" class="input-xlarge" id="arelation" value="<?php echo $arelation ?>">
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Phone</label>
								<div class="controls">
								  <input name="aphone" type="text" class="input-xlarge" id="aphone" value="<?php echo $aphone ?>">
								</div>
							  </div>
                              
                                                            
                              <div class="control-group">
								<label class="control-label" for="alname">T-Shirt Size</label>
								<div class="controls">
								  <input name="at-shirt_size" type="text" class="input-xlarge" id="at-shirt_size" value="<?php echo $atshirt_size ?>">
								</div>
							  </div>
                              
                            
							  
						
							</fieldset>
						
					
					</div>
                    
                    
                    
                     <div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> Training Dates</h2>
					</div>
					<div class="box-content">
						
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="alname">November 7- 9, 2013</label>
								<div class="controls">
								  <input name="event_date" type="checkbox" class="input-xlarge disabled" id="event_date" value="November 7- 9, 2013" checked readonly>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Security Code</label>
								<div class="controls">
								  <img src='admin/models/captcha.php'>
								</div>
							  </div>
                              
                              <div class="control-group">
								<label class="control-label" for="alname">Enter Security Code</label>
								<div class="controls">
								  <input name='captcha' type='text' class="input-xlarge">
								</div>
							  </div>
                              
							  
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
                                <p>**Please note that space is limited to two people per franchise.  If you are interested in bringing more than two people per franchise there is a fee of $500 per person.   Contact your franchise consultant for more information.   </p>
							  </div>
							</fieldset>
						
					
					</div>
                    </form>
                    <?php } ?>
				</div><!--/span-->
			  
			</div><!--/row-->
			
			<!--/row-->
    
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

	
		
	</div>

<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.min.js"></script>
	<script src="js/jquery.flot.pie.min.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="js/charisma.js"></script>

	
	
</body>
</html>
