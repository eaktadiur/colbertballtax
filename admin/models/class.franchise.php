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
	private $efin ;
	private $active_date ;
	private $developer ;
	private $dob ;
	private $marital_status ;
	
	private $adob ;
	private $amarital_status ;
	
	private $laddress2 ;
	private $lstore2 ;
	private $lstore_type2 ;
	private $lcity_state_zip2 ;
	private $lemail2 ;
	private $lwebsite2 ;
	private $lphonee2 ;
	private $lphone22 ;
	private $lfax2 ;
	private $efin2 ;
	private $active_date2 ;
	private $developer2 ;
	
	private $laddress3 ;
	private $lstore3 ;
	private $lstore_type3 ;
	private $lcity_state_zip3 ;
	private $lemail3 ;
	private $lwebsite3 ;
	private $lphone3 ;
	private $lphone23 ;
	private $lfax3 ;
	private $efin3 ;
	private $active_date3 ;
	private $developer3 ;
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
							$lphonee2,
							$lphone2,
							$lfax,
							$efin2,
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
							$developer3)
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
		$this->efin = $efin;
		$this->active_date = $active_date;
		$this->developer = $developer;
		
		$this->dob = $dob;
		$this->marital_status = $marital_status;
		
		$this->adob = $adob;
		$this->amarital_status = $amarital_status;
		
		$this->laddress2 = $laddress2;
		$this->lstore2 = $lstore2;
		$this->lstore_type2 = $lstore_type2;
		$this->lcity_state_zip2 = $lcity_state_zip2;
		$this->lemail2 = $lemail2;
		$this->lwebsite2 = $lwebsite2;
		$this->lphonee2 = $lphonee2;
		$this->lphone22 = $lphone22;
		$this->lfax2 = $lfax2;
		$this->efin2 = $efin2;
		$this->active_date2 = $active_date2;
		$this->developer2 = $developer2;
		
		$this->laddress3 = $laddress3;
		$this->lstore3 = $lstore3;
		$this->lstore_type3 = $lstore_type3;
		$this->lcity_state_zip3 = $lcity_state_zip3;
		$this->lemail3 = $lemail3;
		$this->lwebsite3 = $lwebsite3;
		$this->lphone3 = $lphone3;
		$this->lphone23 = $lphone23;
		$this->lfax3 = $lfax3;
		$this->efin3 = $efin3;
		$this->active_date3 = $active_date3;
		$this->developer3 = $developer3;

		
		
		
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
					//$this->mail_failure = true;
				}
				else
				{
					//Send the mail. Specify users email here and subject. 
					//SendMail can have a third parementer for message if you do not wish to build a template.
					
					if(!$mail->sendMail($this->clean_email,"New User"))
					{
						//$this->mail_failure = true;
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
					efin,
					active_date,
					developer,
					dob,
					marital_status,
					
					adob,
					amarital_status,
					
					laddress2,
					lstore2,
					lstore_type2,
					lcity_state_zip2,
					lemail2,
					lwebsite2,
					lphonee2,
					lphone22,
					lfax2,
					efin2,
					active_date2,
					developer2,
					
					laddress3,
					lstore3,
					lstore_type3,
					lcity_state_zip3,
					lemail3,
					lwebsite3,
					lphone3,
					lphone23,
					lfax3,
					efin3,
					active_date3,
					developer3 ,
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
					?,
					?,
					'".time()."'
					)");
				
				$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", 
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
								$this->lfax ,
								$this->efin ,
								$this->active_date ,
								$this->developer ,
								$this->dob ,
								$this->marital_status ,
								
								$this->adob ,
								$this->amarital_status ,
								
								$this->laddress2 ,
								$this->lstore2 ,
								$this->lstore_type2 ,
								$this->lcity_state_zip2 ,
								$this->lemail2 ,
								$this->lwebsite2 ,
								$this->lphonee2 ,
								$this->lphone22 ,
								$this->lfax2 ,
								$this->efin2 ,
								$this->active_date2 ,
								$this->developer2 ,
								
								$this->laddress3 ,
								$this->lstore3 ,
								$this->lstore_type3 ,
								$this->lcity_state_zip3 ,
								$this->lemail3 ,
								$this->lwebsite3 ,
								$this->lphone3 ,
								$this->lphone23 ,
								$this->lfax3 ,
								$this->efin3 ,
								$this->active_date3 ,
								$this->developer3 
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