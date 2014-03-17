<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/


class franchiseEdit 
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
	private $laddress;
	private $lstore;
	private $lstore_type;
	private $lcity_state_zip;
	private $lemail;
	private $lwebsite;
	private $lphone;
	private $lphone2;
	private $lfax;
	private $comment;
	private $id;
	public $status = false;
	public $sql_failure = false;
	public $mail_failure = false;
	public $email_taken = false;
	public $username_taken = false;
	public $displayname_taken = false;
	public $activation_token = 0;
	public $success = NULL;
	
	function __construct(
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
							$comment)
	{
		
		//Sanitize
		$this->clean_email = sanitize($email);
		
		$this->id = $id;
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
		$this->laddress = $laddress;
		$this->lstore = $lstore;
		$this->lstore_type = $lstore_type;
		$this->lcity_state_zip = $lcity_state_zip;
		$this->lemail = $lemail;
		$this->lwebsite = $lwebsite;
		$this->lphone = $lphone;
		$this->lphone2 = $lphone2;
		$this->lfax = $lfax;
		$this->comment = $comment;

		
		
		
	
			$this->status = true;

	}
	
	public function modifyFranchise()
	{
		global $mysqli,$emailActivation,$websiteUrl,$db_table_prefix;
		
		//Prevent this function being called if there were construction errors
		if($this->status)
		{
			
			
				//Insert the user into the database providing no errors have been found.
				$stmt = $mysqli->prepare("UPDATE ".$db_table_prefix."franchise SET
					fname = ?,
					lname = ?,
					ssefin = ?,
					email = ?,
					phone_business = ?,
					phone = ?,
					home_phone = ?,
					fax = ?,
					address = ?,
					city_state_zip = ?,
					developer_bank = ?,
					software = ?,
					afname = ?,
					alname = ?,
					aemail = ?,
					primary_phone = ?,
					aphone = ?,
					afax = ?,
					acity_state_zip = ?,
					file = ?,
					laddress = ?,
					lstore = ?,
					lstore_type = ?,
					lcity_state_zip = ?,
					lemail = ?,
					lwebsite = ?,
					lphone = ?,
					lphone2 = ?,
					lfax = ?,
					comments = ?,
					date_modified = '".time()."'
					WHERE
		id = ?");
				
				$stmt->bind_param("ssssssssssssssssssssssssssssssi", 
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
								$this->comment ,
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