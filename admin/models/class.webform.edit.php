<?php

/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

class leadEdit {

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
    private $event_type;
    public $status = false;
    public $sql_failure = false;
    public $mail_failure = false;
    public $email_taken = false;
    public $username_taken = false;
    public $displayname_taken = false;
    public $activation_token = 0;
    public $success = NULL;

    function __construct($id, $fname, $lname, $address, $city_state_zip, $phone, $mobile, $fax, $tshirt_size, $email, $afname, $alname, $aemail, $arelation, $aphone, $atshirt_size, $modify_by, $event_type) {

        //Sanitize
        $this->clean_email = sanitize($email);

        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->address = $address;
        $this->city_state_zip = $city_state_zip;
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
        //$this->event_date = $event_date;
        $this->event_type = $event_type;
        $this->modify_by = $modify_by;

        //No problems have been found.
        $this->status = true;
    }

    public function modifyLead() {
        global $mysqli, $emailActivation, $websiteUrl, $db_table_prefix;

        //Prevent this function being called if there were construction errors
        if ($this->status) {

            $history = gmdate('Y-m-d') . " | " . $this->modify_by;
            //Insert the user into the database providing no errors have been found.
            
            
            $stmt = $mysqli->prepare("UPDATE " . $db_table_prefix . "leads SET
					fname = '$this->fname',
					lname = '$this->lname',
					address = '$this->address',
					city_state_zip = '$this->city_state_zip',
					phone = '$this->phone',
					mobile = '$this->mobile',
					fax = '$this->fax',
					tshirt_size = '$this->tshirt_size',
					email = '$this->clean_email',
					afname = '$this->afname',
					alname = '$this->alname',
					aemail = '$this->aemail',
					arelation = '$this->arelation',
					aphone = '$this->aphone',
					atshirt_size = '$this->atshirt_size',
                                        event_type='$this->event_type',
					modify_history = modify_history + '$history'
					WHERE id = '$this->id'");

            $stmt->execute();
            //$inserted_id = $mysqli->insert_id;
            $stmt->close();
            $this->success = lang("ACCOUNT_DETAILS_UPDATED");
        }
    }

}

?>