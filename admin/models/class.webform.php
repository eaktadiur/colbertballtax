<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/


class lead 
{

	private $fname;
	private $lname;
	private $address;
	private $city_state_zip;
	private $phone;
	private $mobile;
	private $fax;
	private $tshirt_size;
	private $clean_email;
	private $afname;
	private $alname;
	private $aemail;
	private $arelation;
	private $aphone;
	private $atshirt_size;
	private $event_date;
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
							$event_date)
	{
		
		//Sanitize
		$this->clean_email = sanitize($email);
		
		$this->fname =$fname;
		$this->lname = $lname ;
		$this->address =$address;
		$this->city_state_zip =$city_state_zip;
		$this->phone = $phone;
		$this->mobile = $mobile;
		$this->fax = $fax;
		$this->tshirt_size = $tshirt_size;
		$this->afname = $afname;
		$this->alname = $alname;
		$this->aemail = $aemail;
		$this->arelation = $arelation;
		$this->aphone = $aphone;
		$this->atshirt_size = $atshirt_size;
		$this->event_date = $event_date;
		
		if(leadExists($this->clean_email))
		{
			$this->email_taken = true;
		}
		else
		{
			//No problems have been found.
			$this->status = true;
		}
	}
	
	public function AddLead()
	{
		global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;
		
		//Prevent this function being called if there were construction errors
		if($this->status)
		{
			
			
			/*//Do we need to send out an activation email?
			if($emailActivation == "true")
			{
				//User must activate their account first
				$this->user_active = 0;
				
				$mail = new userCakeMail();
				
				//Build the activation message
				$activation_message = lang("ACCOUNT_ACTIVATION_MESSAGE",array($websiteUrl,$this->activation_token));
				
				//Define more if you want to build larger structures
				$hooks = array(
					"searchStrs" => array("#ACTIVATION-MESSAGE","#ACTIVATION-KEY","#USERNAME#"),
					"subjectStrs" => array($activation_message,$this->activation_token,$this->displayname)
					);
				
				/* Build the template - Optional, you can just use the sendMail function 
				Instead to pass a message. */
				
				/*if(!$mail->newTemplateMsg("new-registration.txt",$hooks))
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
				$this->success = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE2");
			}
			else
			{
				//Instant account activation
				$this->user_active = 1;
				$this->success = lang("ACCOUNT_REGISTRATION_COMPLETE_TYPE1");
			}	*/
			
			
			if(!$this->mail_failure)
			{
				//Insert the user into the database providing no errors have been found.
				$stmt = $mysqli->prepare("INSERT INTO ".$db_table_prefix."leads (
					fname,
					lname,
					address,
					city_state_zip,
					phone,
					mobile,
					fax,
					tshirt_size,
					email,
					afname,
					alname,
					aemail,
					arelation,
					aphone,
					atshirt_size,
					event_date,
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
					'".time()."'
					)");
				
				$stmt->bind_param("ssssssssssssssss", 
								$this->fname,
								$this->lname, 
								$this->address, 
								$this->city_state_zip, 
								$this->phone, 
								$this->mobile, 
								$this->fax, 
								$this->tshirt_size,
								$this->clean_email,
								$this->afname, 
								$this->alname, 
								$this->aemail, 
								$this->arelation,
								$this->aphone, 
								$this->atshirt_size, 
								$this->event_date
								  );
				$stmt->execute();
				$inserted_id = $mysqli->insert_id;
				$stmt->close();
				$this->success = lang("WEBFORM_SUCCESS");
			}
		}
	}
}




?>