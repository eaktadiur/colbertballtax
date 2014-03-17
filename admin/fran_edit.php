<?php
if(!franchiseIdExists($leadId)){
	header("Location: franchisee.php"); die();
}

//Forms posted
if(!empty($_POST) && $_POST["id"])
{
	$errors = array();
	$id = trim($_POST["id"]);
	$fname = trim($_POST["fname"]);
	$lname = trim($_POST["lname"]);
	$ssefin = trim($_POST["ssefin"]);
	$email = trim($_POST["email"]);
	$phone_business = trim($_POST["phone_business"]);
	$phone = trim($_POST["phone"]);
	$home_phone = trim($_POST["home_phone"]);
	$fax = trim($_POST["fax"]);
	$address = trim($_POST["address"]);
	$city_state_zip = trim($_POST["city_state_zip"]);
	$developer_bank = trim($_POST["developer_bank"]);
	$software = trim($_POST["software"]);
	$afname = trim($_POST["afname"]);
	$alname = trim($_POST["alname"]);
	$aemail = trim($_POST["aemail"]);
	$primary_phone = trim($_POST["primary_phone"]);
	$aphone = trim($_POST["aphone"]);
	$afax = trim($_POST["afax"]);
	$acity_state_zip = trim($_POST["acity_state_zip"]);
	$files = $_FILES["files"]["name"];
	$temp_name = $_FILES["files"]["tmp_name"];
	$file_error = $_FILES["files"]["error"];
	$laddress = trim($_POST["laddress"]);
	$lstore = trim($_POST["lstore"]);
	$lstore_type = trim($_POST["lstore_type"]);
	$lcity_state_zip = trim($_POST["lcity_state_zip"]);
	$lemail = trim($_POST["lemail"]);
	$lwebsite = trim($_POST["lwebsite"]);
	$lphone = trim($_POST["lphone"]);
	$lphone2 = trim($_POST["lphone2"]);
	$last_bank = trim($_POST["last_bank"]);
	$ssn_name = trim($_POST["ssn_name"]);
	$current_bank = trim($_POST["current_bank"]);
	$bank_product = trim($_POST["bank_product"]);
	$account_type = trim($_POST["account_type"]);
	$routing_number = trim($_POST["routing_number"]);
	$routing_number_confirm = trim($_POST["routing_number_confirm"]);
	$account_no = trim($_POST["account_no"]);
	$account_no_confirm = trim($_POST["account_no_confirm"]);
	
	$dob = trim($_POST["dob"]);
	$marital_status = trim($_POST["marital_status"]);
	
	$adob = trim($_POST["adob"]);
	$amarital_status = trim($_POST["amarital_status"]);

	$efin = trim($_POST["efin"]);
	$active_date = trim($_POST["active_date"]);
	$developer = trim($_POST["developer"]);
	
	$laddress2 = trim($_POST["laddress2"]);
	$lstore2 = trim($_POST["lstore2"]);
	$lstore_type2 = trim($_POST["lstore_type2"]);
	$lcity_state_zip2 = trim($_POST["lcity_state_zip2"]);
	$lemail2 = trim($_POST["lemail2"]);
	$lwebsite2 = trim($_POST["lwebsite2"]);
	$lphonee2 = trim($_POST["lphonee2"]);
	$lphone22 = trim($_POST["lphone22"]);
	$lfax2 = trim($_POST["lfax2"]);
	$efin2 = trim($_POST["efin2"]);
	$active_date2 = trim($_POST["active_date2"]);
	$developer2 = trim($_POST["developer2"]);
	
	$laddress3 = trim($_POST["laddress3"]);
	$lstore3 = trim($_POST["lstore3"]);
	$lstore_type3 = trim($_POST["lstore_type3"]);
	$lcity_state_zip3 = trim($_POST["lcity_state_zip3"]);
	$lemail3 = trim($_POST["lemail3"]);
	$lwebsite3 = trim($_POST["lwebsite3"]);
	$lphone3 = trim($_POST["lphone3"]);
	$lphone23 = trim($_POST["lphone23"]);
	$lfax3 = trim($_POST["lfax3"]);
	$efin3 = trim($_POST["efin3"]);
	$active_date3 = trim($_POST["active_date3"]);
	$developer3 = trim($_POST["developer3"]);
	
		
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
	if(!$files == "")
	{
		if(!isFileType($files))
			{
				$errors[] = lang("FIlE_TYPE_NOT_SUPORTED");
			}
	}

	//End data validation
	if(count($errors) == 0)
	{	
	
	
	if(!$files == "")
	{
	$allowedExts = array("jpg", "jpeg", "gif", "png", "doc", "docx", "txt", "rtf", "pdf", "xls", "xlsx", "ppt", "pptx", "pdf");
	$temp = explode(".", $_FILES["files"]["name"]);
	$extension = end($temp);
	if (in_array($extension, $allowedExts))
	  {
	  if ($_FILES["files"]["error"] > 0)
		$errors[] =  $_FILES["file"]["error"] ;
	  else
		{
		
		 $ran = rand();
		if (file_exists($_SERVER['DOCUMENT_ROOT'].BACK_ROOT."upload/".$ran.$_FILES["files"]["name"]))
		  $errors[] =  $ran.$_FILES["files"]["name"] . " already exists. ";
		else
		  {
		  move_uploaded_file($_FILES["files"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'].BACK_ROOT."upload/" .$ran.$_FILES["files"]["name"]);
		  $files = $ran. $_FILES["files"]["name"];
		  }
		}}
		}
		else 
		 $files =  $leaddetails[0]['file'];
		
		//Construct a user object
		$lead = new franchiseEdit(
							$id,
							$fname,
							$lname,
							$ssefin,
							$email,
							$phone_business,
							$phone,
							$home_phone,
							$fax,
							$address,
							$city_state_zip,
							$developer_bank,
							$software,
							$afname,
							$alname,
							$aemail,
							$primary_phone,
							$aphone,
							$afax,
							$acity_state_zip,
							$files,
							$laddress,
							$lstore,
							$lstore_type,
							$lcity_state_zip,
							$lemail,
							$lwebsite,
							$lphone,
							$lphone2,
							$lfax,
							$last_bank ,
							$ssn_name ,
							$current_bank ,
							$bank_product ,
							$account_type ,
							$routing_number,
							$routing_number_confirm ,
							$account_no ,
							$account_no_confirm ,
							$comment,
							$efin ,
							$active_date ,
							$developer ,
							$dob ,
							$marital_status ,
							
							$adob ,
							$amarital_status ,
							
							$laddress2 ,
							$lstore2 ,
							$lstore_type2 ,
							$lcity_state_zip2 ,
							$lemail2 ,
							$lwebsite2 ,
							$lphonee2 ,
							$lphone22 ,
							$lfax2 ,
							$efin2 ,
							$active_date2 ,
							$developer2 ,
							
							$laddress3 ,
							$lstore3 ,
							$lstore_type3 ,
							$lcity_state_zip3 ,
							$lemail3 ,
							$lwebsite3 ,
							$lphone3 ,
							$lphone23 ,
							$lfax3 ,
							$efin3 ,
							$active_date3 ,
							$developer3 
							);
		
		
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$lead->modifyFranchise())
			{
				//if($lead->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($lead->sql_failure)  $errors[] = lang("SQL_ERROR");
				
			}
			
		
	}
	if(count($errors) == 0) {
		$successes[] = $lead->success;
$leaddetails = fetchFranchisedetails($leadId);
	}
}


?>

                    
                    <?php echo resultBlock($errors,$successes); ?>
                     <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
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
                            <td nowrap="nowrap">Social Security EFIN <br />
                            (123-45-678)   </td>
                            <td><input name="ssefin" type="text" class="input-xlarge focused" id="ssefin" value="<?php echo $leaddetails[0]['ssefin']; ?>" readonly="readonly" /></td>
                            <td>E-Mail Address</td>
                            <td><input name="email" type="text" class="input-xlarge focused" id="email" value="<?php echo $leaddetails[0]['email']; ?>"  /></td>
                          </tr>
                          <tr>
                            <td>Primary Phone Business </td>
                            <td><input name="phone_business" type="text" class="input-xlarge focused" id="phone_business" value="<?php echo $leaddetails[0]['phone_business']; ?>" /></td>
                            <td> Phone </td>
                            <td><input name="phone" type="text" class="input-xlarge focused" id="phone" value="<?php echo $leaddetails[0]['phone']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Home Phone </td>
                            <td><input name="home_phone" type="text" class="input-xlarge focused" id="home_phone" value="<?php echo $leaddetails[0]['home_phone']; ?>" /></td>
                            <td>Fax </td>
                            <td><input name="fax" type="text" class="input-xlarge focused" id="fax" value="<?php echo $leaddetails[0]['fax']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Mailing Address </td>
                            <td><input name="address" type="text" class="input-xlarge focused" id="address" value="<?php echo $leaddetails[0]['address']; ?>" /></td>
                            <td>City/State/Zip</td>
                            <td><input name="city_state_zip" type="text" class="input-xlarge focused" id="city_state_zip" value="<?php echo $leaddetails[0]['city_state_zip']; ?>" /></td>
                          </tr>
                         <tr>
                            <td>Developer  Bank Product </td>
                            <td><select name="developer_bank" id="developer_bank">
								    <option>Select</option>
								    <option value="Republic Bank " <?php if ($leaddetails[0]['developer_bank'] == "Republic Bank") echo "selected"; ?>>Republic Bank </option>
								    <option value="Refund Advantage" <?php if ($leaddetails[0]['developer_bank'] == "Refund Advantage") echo "selected"; ?>>Refund Advantage</option>
								  </select></td>
                            <td>Software</td>
                            <td><select name="software" id="software">
								    <option>Select</option>
								    <option value="Taxslayer" <?php if ($leaddetails[0]['developer_bank'] == "Taxslayer") echo "selected"; ?>>Taxslayer</option>
								    <option value="Drake" <?php if ($leaddetails[0]['developer_bank'] == "Drake") echo "selected"; ?>>Drake</option>
								    <option value="Crosslink" <?php if ($leaddetails[0]['developer_bank'] == "Crosslink") echo "selected"; ?>>Crosslink</option>
                                  </select></td>
                          </tr>
                         <tr class="table table-striped table-bordered ">
                           <td>Birth Date </td>
                           <td><input name="dob" type="text" class="input-xlarge focused" id="dob" value="<?php echo $leaddetails[0]['dob']; ?>" /></td>
                           <td>Marital Status </td>
                           <td><input name="marital_status" type="text" class="input-xlarge focused" id="marital_status" value="<?php echo $leaddetails[0]['marital_status']; ?>" /></td>
                         </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Partner  Information</strong></td>
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
                            <td>Primary Phone </td>
                            <td><input name="primary_phone" type="text" class="input-xlarge focused" id="primary_phone" value="<?php echo $leaddetails[0]['primary_phone']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Business Phone</td>
                            <td><input name="aphone" type="text" class="input-xlarge focused" id="aphone" value="<?php echo $leaddetails[0]['aphone']; ?>" /></td>
                            <td>Fax</td>
                            <td><input name="afax" type="text" class="input-xlarge focused" id="afax" value="<?php echo $leaddetails[0]['afax']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>City/State/Zip</td>
                            <td><input name="acity_state_zip" type="text" class="input-xlarge focused" id="acity_state_zip" value="<?php echo $leaddetails[0]['acity_state_zip']; ?>" /></td>
                            <td>Document Upload(EFIN letter)</td>
                            <td><input name="files" type="file" class="input-xlarge" id="files" ><br />
<a href="<?php echo BACK_ROOT."upload/".$leaddetails[0]['file']?>" target="_blank"><?php echo $leaddetails[0]['file']; ?></a></td>
                          </tr>
                          <tr class="table table-striped table-bordered ">
                           <td>Birth Date </td>
                           <td><input name="adob" type="text" class="input-xlarge focused" id="adob" value="<?php echo $leaddetails[0]['adob']; ?>" /></td>
                           <td>Marital Status </td>
                           <td><input name="amarital_status" type="text" class="input-xlarge focused" id="amarital_status" value="<?php echo $leaddetails[0]['amarital_status']; ?>" /></td>
                         </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Location   Information</strong></td>
                            </tr>
                          <tr>
                            <td colspan="4"><strong>1.</strong></td>
                            </tr>
                          <tr>
                            <td>Location Address </td>
                            <td><input name="laddress" type="text" class="input-xlarge focused" id="laddress" value="<?php echo $leaddetails[0]['laddress']; ?>" /></td>
                            <td>Store Category </td>
                            <td><input name="lstore" type="text" class="input-xlarge focused" id="lstore" value="<?php echo $leaddetails[0]['lstore']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Store Type </td>
                            <td><input name="lstore_type" type="text" class="input-xlarge focused" id="lstore_type" value="<?php echo $leaddetails[0]['lstore_type']; ?>" /></td>
                            <td>City/State/Zip </td>
                            <td><input name="lcity_state_zip" type="text" class="input-xlarge focused" id="lcity_state_zip" value="<?php echo $leaddetails[0]['lcity_state_zip']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td><input name="lemail" type="text" class="input-xlarge focused" id="lemail" value="<?php echo $leaddetails[0]['lemail']; ?>" /></td>
                            <td>Website</td>
                            <td><input name="lwebsite" type="text" class="input-xlarge focused" id="lwebsite" value="<?php echo $leaddetails[0]['lwebsite']; ?>" /></td>
                          </tr>
                          <tr>
                            <td>Primary Phone </td>
                            <td><input name="lphone" type="text" class="input-xlarge focused" id="lphone" value="<?php echo $leaddetails[0]['lphone']; ?>" /></td>
                            <td>Secondary Phone</td>
                            <td><input name="lphone2" type="text" class="input-xlarge focused" id="lphone2" value="<?php echo $leaddetails[0]['lphone2']; ?>" /></td>
                          </tr>
                           <tr>
                            <td>Fax</td>
                            <td><input name="lfax" type="text" class="input-xlarge focused" id="lfax" value="<?php echo $leaddetails[0]['lfax']; ?>" /></td>
                            <td>EFIN</td>
                            <td><input name="efin" type="text" class="input-xlarge focused" id="efin" value="<?php echo $leaddetails[0]['efin']; ?>" /></td>
                          </tr>
                           <tr class="table table-striped table-bordered ">
                             <td>Active Date </td>
                             <td><input name="active_date" type="text" class="input-xlarge focused" id="active_date" value="<?php echo $leaddetails[0]['active_date']; ?>" /></td>
                             <td>Developer</td>
                             <td><input name="developer" type="text" class="input-xlarge focused" id="developer" value="<?php echo $leaddetails[0]['developer']; ?>" /></td>
                           </tr>
                           <tr>
                             <td colspan="4"><strong>2.</strong></td>
                           </tr>
                           <tr>
                             <td>Location Address </td>
                             <td><input name="laddress2" type="text" class="input-xlarge focused" id="laddress2" value="<?php echo $leaddetails[0]['laddress2']; ?>" /></td>
                             <td>Store Category </td>
                             <td><input name="lstore2" type="text" class="input-xlarge focused" id="lstore2" value="<?php echo $leaddetails[0]['lstore2']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Store Type </td>
                             <td><input name="lstore_type2" type="text" class="input-xlarge focused" id="lstore_type2" value="<?php echo $leaddetails[0]['lstore_type2']; ?>" /></td>
                             <td>City/State/Zip </td>
                             <td><input name="lcity_state_zip2" type="text" class="input-xlarge focused" id="lcity_state_zip2" value="<?php echo $leaddetails[0]['lcity_state_zip2']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Email</td>
                             <td><input name="lemail2" type="text" class="input-xlarge focused" id="lemail2" value="<?php echo $leaddetails[0]['lemail2']; ?>" /></td>
                             <td>Website</td>
                             <td><input name="lwebsite2" type="text" class="input-xlarge focused" id="lwebsite2" value="<?php echo $leaddetails[0]['lwebsite2']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Primary Phone </td>
                             <td><input name="lphonee2" type="text" class="input-xlarge focused" id="lphonee2" value="<?php echo $leaddetails[0]['lphonee2']; ?>" /></td>
                             <td>Secondary Phone</td>
                             <td><input name="lphone22" type="text" class="input-xlarge focused" id="lphone22" value="<?php echo $leaddetails[0]['lphone22']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Fax</td>
                             <td><input name="lfax2" type="text" class="input-xlarge focused" id="lfax2" value="<?php echo $leaddetails[0]['lfax2']; ?>" /></td>
                             <td>EFIN</td>
                             <td><input name="efin2" type="text" class="input-xlarge focused" id="efin2" value="<?php echo $leaddetails[0]['efin2']; ?>" /></td>
                           </tr>
                           <tr class="table table-striped table-bordered ">
                             <td>Active Date </td>
                             <td><input name="active_date2" type="text" class="input-xlarge focused" id="active_date2" value="<?php echo $leaddetails[0]['active_date2']; ?>" /></td>
                             <td>Developer</td>
                             <td><input name="developer2" type="text" class="input-xlarge focused" id="developer2" value="<?php echo $leaddetails[0]['developer2']; ?>" /></td>
                           </tr>
                           <tr>
                             <td colspan="4"><strong>3.</strong></td>
                           </tr>
                           <tr>
                             <td>Location Address </td>
                             <td><input name="laddress3" type="text" class="input-xlarge focused" id="laddress3" value="<?php echo $leaddetails[0]['laddress3']; ?>" /></td>
                             <td>Store Category </td>
                             <td><input name="lstore3" type="text" class="input-xlarge focused" id="lstore3" value="<?php echo $leaddetails[0]['lstore3']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Store Type </td>
                             <td><input name="lstore_type3" type="text" class="input-xlarge focused" id="lstore_type3" value="<?php echo $leaddetails[0]['lstore_type3']; ?>" /></td>
                             <td>City/State/Zip </td>
                             <td><input name="lcity_state_zip3" type="text" class="input-xlarge focused" id="lcity_state_zip3" value="<?php echo $leaddetails[0]['lcity_state_zip3']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Email</td>
                             <td><input name="lemail3" type="text" class="input-xlarge focused" id="lemail3" value="<?php echo $leaddetails[0]['lemail3']; ?>" /></td>
                             <td>Website</td>
                             <td><input name="lwebsite3" type="text" class="input-xlarge focused" id="lwebsite3" value="<?php echo $leaddetails[0]['lwebsite3']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Primary Phone </td>
                             <td><input name="lphone3" type="text" class="input-xlarge focused" id="lphone3" value="<?php echo $leaddetails[0]['lphone3']; ?>" /></td>
                             <td>Secondary Phone</td>
                             <td><input name="lphone23" type="text" class="input-xlarge focused" id="lphone23" value="<?php echo $leaddetails[0]['lphone23']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Fax</td>
                             <td><input name="lfax3" type="text" class="input-xlarge focused" id="lfax3" value="<?php echo $leaddetails[0]['lfax3']; ?>" /></td>
                             <td>EFIN</td>
                             <td><input name="efin3" type="text" class="input-xlarge focused" id="efin3" value="<?php echo $leaddetails[0]['efin3']; ?>" /></td>
                           </tr>
                           <tr class="table table-striped table-bordered ">
                             <td>Active Date </td>
                             <td><input name="active_date3" type="text" class="input-xlarge focused" id="active_date3" value="<?php echo $leaddetails[0]['active_date3']; ?>" /></td>
                             <td>Developer</td>
                             <td><input name="developer3" type="text" class="input-xlarge focused" id="developer3" value="<?php echo $leaddetails[0]['developer3']; ?>" /></td>
                           </tr>
                           <tr>
                             <td colspan="4">&nbsp;</td>
                           </tr>
                           <tr>
                             <td colspan="4"><strong>Bank Information </strong></td>
                           </tr>
                           <tr>
                             <td>What bank did you use last tax season?</td>
                             <td><input name="last_bank" type="text" class="input-xlarge focused" id="last_bank" value="<?php echo $leaddetails[0]['last_bank']; ?>" /></td>
                             <td>Company EIN or SSN</td>
                             <td><input name="ssefin2" type="text" class="input-xlarge focused" id="ssefin2" value="<?php echo $leaddetails[0]['ssefin']; ?>" readonly="readonly" /></td>
                           </tr>
                           <tr>
                             <td>Business name EIN registered under, or SSN name</td>
                             <td><input name="ssn_name" type="text" class="input-xlarge focused" id="ssn_name" value="<?php echo $leaddetails[0]['ssn_name']; ?>" /></td>
                             <td>Which bank will you use this tax season?</td>
                             <td><input name="current_bank" type="text" class="input-xlarge focused" id="current_bank" value="<?php echo $leaddetails[0]['current_bank']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Estimated Number of bank products - 2013</td>
                             <td><input name="bank_product" type="text" class="input-xlarge focused" id="bank_product" value="<?php echo $leaddetails[0]['bank_product']; ?>" /></td>
                             <td>In what type of account will your fees be deposited?</td>
                             <td><input name="account_type" type="text" class="input-xlarge focused" id="account_type" value="<?php echo $leaddetails[0]['account_type']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Routing Number</td>
                             <td><input name="routing_number" type="text" class="input-xlarge focused" id="routing_number" value="<?php echo $leaddetails[0]['routing_number']; ?>" /></td>
                             <td>Confirm Routing Number</td>
                             <td><input name="routing_number_confirm" type="text" class="input-xlarge focused" id="routing_number_confirm" value="<?php echo $leaddetails[0]['routing_number_confirm']; ?>" /></td>
                           </tr>
                           <tr>
                             <td>Account Number</td>
                             <td><input name="account_no" type="text" class="input-xlarge focused" id="account_no" value="<?php echo $leaddetails[0]['account_no']; ?>" /></td>
                             <td>Confirm Account Number</td>
                             <td><input name="account_no_confirm" type="text" class="input-xlarge focused" id="account_no_confirm" value="<?php echo $leaddetails[0]['account_no_confirm']; ?>" /></td>
                           </tr>
                          
                          </tbody>
					  </table>            
                      <p><button type="submit" class="btn btn-primary"  name="edit">Save changes</button></p>
                      <input type="hidden" name="id" value="<?php echo $leaddetails[0]['id']; ?>" />

                      </form>
					