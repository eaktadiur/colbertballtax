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
	private $last_bank ;
	private $ssn_name ;
	private $current_bank ;
	private $bank_product ;
	private $account_type ;
	private $routing_number;
	private $routing_number_confirm ;
	private $account_no ;
	private $account_no_confirm ;
	private $comment;
	private $id;
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
							
							$efin,
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
		$this->last_bank = $last_bank;
		$this->ssn_name = $ssn_name;
		$this->current_bank = $current_bank;
		$this->bank_product = $bank_product;
		$this->account_type = $account_type;
		$this->routing_number = $routing_number;
		$this->routing_number_confirm = $routing_number_confirm;
		$this->account_no = $account_no;
		$this->account_no_confirm = $account_no_confirm;
		$this->comment = $comment;
		
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
					last_bank = ?,
					ssn_name = ?,
					current_bank = ?,
					bank_product = ?,
					account_type = ?,
					routing_number= ?,
					routing_number_confirm = ?,
					account_no = ?,
					account_no_confirm = ?,
					comments = ?,
					efin = ?,
					active_date = ?,
					developer = ?,
					dob = ?,
					marital_status = ?,
					
					adob = ?,
					amarital_status = ?,
					
					laddress2 = ?,
					lstore2 = ?,
					lstore_type2 = ?,
					lcity_state_zip2 = ?,
					lemail2 = ?,
					lwebsite2 = ?,
					lphone2 = ?,
					lphone22 = ?,
					lfax2 = ?,
					efin2 = ?,
					active_date2 = ?,
					developer2 = ?,
					
					laddress3 = ?,
					lstore3 = ?,
					lstore_type3 = ?,
					lcity_state_zip3 = ?,
					lemail3 = ?,
					lwebsite3 = ?,
					lphone3 = ?,
					lphone23 = ?,
					lfax3 = ?,
					efin3 = ?,
					active_date3 = ?,
					developer3 = ?,
					date_modified = '".time()."'
					WHERE
		id = ?");
				
				$stmt->bind_param("ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssi", 
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
								$this->last_bank ,
								$this->ssn_name ,
								$this->current_bank ,
								$this->bank_product ,
								$this->account_type ,
								$this->routing_number,
								$this->routing_number_confirm ,
								$this->account_no ,
								$this->account_no_confirm ,
								$this->comment ,
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
								$this->lphone2 ,
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
								$this->developer3 ,
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