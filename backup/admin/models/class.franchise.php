<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/


class franchise 
{
	private $fname;
	private $lname;
	private $ssefin;
	private $clean_email;
	private $phone_business;
	private $phone;
	private $home_phone;
	private $fax;
	private $address;
	private $city_state_zip;
	private $developer_bank;
	private $software;
	private $afname;
	private $alname;
	private $aemail;
	private $primary_phone;
	private $aphone;
	private $afax;
	private $acity_state_zip;
	private $files ;
	private $temp_file ;
	private $file_error;
	private $laddress;
	private $lstore;
	private $lstore_type;
	private $lcity_state_zip;
	private $lemail;
	private $lwebsite;
	private $lphone;
	private $lphone2;
	private $lfax;
	public $status = false;
	public $sql_failure = false;
	public $mail_failure = false;
	public $email_taken = false;
	public $username_taken = false;
	public $displayname_taken = false;
	public $activation_token = 0;
	public $success = NULL;
	
	function __construct($fname,
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
							$temp_file,
							$file_error,
							$laddress,
							$lstore,
							$lstore_type,
							$lcity_state_zip,
							$lemail,
							$lwebsite,
							$lphone,
							$lphone2,
							$lfax)
	{
		
		//Sanitize
		$this->clean_email = sanitize($email);
		
		$this->fname = $fname;
		$this->lname = $lname;
		$this->ssefin = $ssefin;
		$this->phone_business = $phone_business;
		$this->phone = $phone;
		$this->home_phone = $home_phone;
		$this->fax = $fax;
		$this->address = $address;
		$this->city_state_zip = $city_state_zip;
		$this->developer_bank = $developer_bank;
		$this->software = $software;
		$this->afname = $afname;
		$this->alname = $alname;
		$this->aemail = $aemail;
		$this->primary_phone = $primary_phone;
		$this->aphone = $aphone;
		$this->afax = $afax;
		$this->acity_state_zip = $acity_state_zip;
		$this->files = $files;
		$this->temp_file = $temp_file;
		$this->file_error = $file_error;
		$this->laddress = $laddress;
		$this->lstore = $lstore;
		$this->lstore_type = $lstore_type;
		$this->lcity_state_zip = $lcity_state_zip;
		$this->lemail = $lemail;
		$this->lwebsite = $lwebsite;
		$this->lphone = $lphone;
		$this->lphone2 = $lphone2;
		$this->lfax = $lfax;

		
		
		
		if(franchiseExists($this->clean_email))
		{
			$this->email_taken = true;
		}
		else if(EFINExists($this->ssefin))
		{
			$this->ssefin_taken = true;
		}
		/*else if($this->files && file_upload_error_message($this->file_error))
		{
			if(!FileUpload($this->files, $this->temp_file ))
			echo file_upload_error_message($this->file_error);
		}*/
		else
		{
			//No problems have been found.
			$this->status = true;
		}
	}
	
	public function AddFranchise()
	{
		global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;
		
		//Prevent this function being called if there were construction errors
		if($this->status)
		{
			
			
			
				
				
				$mail = new userCakeMail();
				
				//Build the activation message
				$activation_message = lang("FRANCHISE_ACTIVATION_MESSAGE",array("http://colbertballtax.com/app/"));
				
				//Define more if you want to build larger structures
				$hooks = array(
					"searchStrs" => array("#ACTIVATION-MESSAGE","#ACTIVATION-KEY","#USERNAME#"),
					"subjectStrs" => array($activation_message,$this->activation_token,$this->fname)
					);
				
				/* Build the template - Optional, you can just use the sendMail function 
				Instead to pass a message. */
				
				if(!$mail->newTemplateMsg("new-franchise.txt",$hooks))
				{
					$this->mail_failure = true;
				}
				else
				{
					//Send the mail. Specify users email here and subject. 
					//SendMail can have a third parementer for message if you do not wish to build a template.
					
					if(!$mail->sendMail($this->clean_email,"New User"))
					{
						$this->mail_failure = true;
					}
				}
				//$this->success = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE2");
			
			
			
			if(!$this->mail_failure)
			{
				//Insert the user into the database providing no errors have been found.
				$stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."franchise (
					fname,
					lname,
					ssefin,
					email,
					phone_business,
					phone,
					home_phone,
					fax,
					address,
					city_state_zip,
					developer_bank,
					software,
					afname,
					alname,
					aemail,
					primary_phone,
					aphone,
					afax,
					acity_state_zip,
					file,
					laddress,
					lstore,
					lstore_type,
					lcity_state_zip,
					lemail,
					lwebsite,
					lphone,
					lphone2,
					lfax,
					date
					)
					VALUES (
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					'".time()."'
					)");
				
				$stmt->bind_param("sssssssssssssssssssssssssssss", 
								$this->fname,
								$this->lname,
								$this->ssefin,
								$this->clean_email,
								$this->phone_business ,
								$this->phone ,
								$this->home_phone,
								$this->fax ,
								$this->address ,
								$this->city_state_zip,
								$this->developer_bank ,
								$this->software ,
								$this->afname ,
								$this->alname ,
								$this->aemail ,
								$this->primary_phone ,
								$this->aphone ,
								$this->afax ,
								$this->acity_state_zip ,
								$this->files ,
								$this->laddress ,
								$this->lstore ,
								$this->lstore_type ,
								$this->lcity_state_zip ,
								$this->lemail,
								$this->lwebsite ,
								$this->lphone ,
								$this->lphone2 ,
								$this->lfax 
								  );
				$stmt->execute();
				$inserted_id = $mysqli->insert_id;
				$stmt->close();
				//Insert default permission into matches table
				$stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."user_permission_matches  (
					user_id,
					permission_id
					)
					VALUES (
					?,
					'3'
					)");
				$stmt->bind_param("s", $inserted_id);
				$stmt->execute();
				$stmt->close();
				$this->success = lang("WEBFORM_SUCCESS");
			}
		}
	}
}

?>