<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/


class leadEdit 
{
	private $id;
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
	private $modify_by;
	public $status = false;
	public $sql_failure = false;
	public $mail_failure = false;
	public $email_taken = false;
	public $username_taken = false;
	public $displayname_taken = false;
	public $activation_token = 0;
	public $success = NULL;
	
	function __construct($id,
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
							$modify_by)
	{
		
		//Sanitize
		$this->clean_email = sanitize($email);
		
		$this->id =$id;
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
		$this->modify_by = $modify_by;
		
					//No problems have been found.
			$this->status = true;

	}
	
	public function modifyLead()
	{
		global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;
		
		//Prevent this function being called if there were construction errors
		if($this->status)
		{
			
			$history = gmdate('Y-m-d')." | ".$this->modify_by;
				//Insert the user into the database providing no errors have been found.
				$stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."leads SET
					fname = ?,
					lname = ?,
					address = ?,
					city_state_zip = ?,
					phone = ?,
					mobile = ?,
					fax = ?,
					tshirt_size = ?,
					email = ?,
					afname = ?,
					alname = ?,
					aemail = ?,
					arelation = ?,
					aphone = ?,
					atshirt_size = ?,
					modify_history = modify_history + ?
					WHERE
		id = ?");
				
				$stmt->bind_param("ssssssssssssssssi", 
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
								$history,
								$this->id
								  );
				$stmt->execute();
				//$inserted_id = $mysqli->insert_id;
				$stmt->close();
				$this->success = lang("ACCOUNT_DETAILS_UPDATED");
			}
		}
	
}

?>