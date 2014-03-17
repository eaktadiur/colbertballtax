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
	$lfax = trim($_POST["lfax"]);
	
	
		
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
							$comment
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
                            <td><input name="email" type="text" class="input-xlarge focused" id="email" value="<?php echo $leaddetails[0]['email']; ?>" readonly="readonly" /></td>
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
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Location   Information</strong></td>
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
                            <td></td>
                            <td></td>
                          </tr>
                          
                          </tbody>
					  </table>            
                      <p><button type="submit" class="btn btn-primary"  name="edit">Save changes</button></p>
                      <input type="hidden" name="id" value="<?php echo $leaddetails[0]['id']; ?>" />

                      </form>
					