<?php

class events {

    private $fname;
    private $lname;
    private $address;
    private $city_state_zip;
    private $phone;
    private $mobile;
    private $fax;
    private $clean_email;
    private $afname;
    private $alname;
    private $aemail;
    private $arelation;
    private $aphone;
    private $event_date;
    private $event_type;
    public $status = false;
    public $sql_failure = false;
    public $mail_failure = false;
    public $email_taken = false;
    public $username_taken = false;
    public $displayname_taken = false;
    public $activation_token = 0;
    public $success = NULL;
    public $sqlerror = '';

    function __construct($fname, $lname, $address, $city_state_zip, $phone, $mobile, $fax, $email, $afname, $alname, $aemail, $arelation, $aphone, $event_date, $event_type) {

        //Sanitize
        $this->clean_email = sanitize($email);

        $this->fname = $fname;
        $this->lname = $lname;
        $this->address = $address;
        $this->city_state_zip = $city_state_zip;
        $this->phone = $phone;
        $this->mobile = $mobile;
        $this->fax = $fax;
        $this->afname = $afname;
        $this->alname = $alname;
        $this->aemail = $aemail;
        $this->arelation = $arelation;
        $this->aphone = $aphone;
        $this->event_date = $event_date;
        $this->event_type = $event_type;

        if (leadExists($this->clean_email)) {
            $this->email_taken = true;
        } else {
            //No problems have been found.
            $this->status = true;
        }
    }

    public function AddEvent() {


        global $mysqli, $emailActivation, $websiteUrl, $db_table_prefix;

        //Prevent this function being called if there were construction errors
        echo "INSERT INTO " . $db_table_prefix . "leads (fname, lname,address,city_state_zip,phone,mobile,fax,email,afname,alname,aemail,arelation, aphone, event_date,event_type, date)
					VALUES ('$this->fname', '$this->lname', '$this->address', '$this->city_state_zip', '$this->phone', '$this->mobile', '$this->fax', '$this->clean_email', '$this->afname', '$this->alname', '$this->aemail', '$this->arelation', '$this->aphone', '$this->event_date', '$this->event_type', NOW())";
        if ($this->status) {



            if (!$this->mail_failure) {

                //Insert the user into the database providing no errors have been found.
                
                $stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "leads (fname, lname,address,city_state_zip,phone,mobile,fax,email,afname,alname,aemail,arelation, aphone, event_date,event_type, date)
					VALUES ('$this->fname', '$this->lname', '$this->address', '$this->city_state_zip', '$this->phone', '$this->mobile', '$this->fax', '$this->clean_email', '$this->afname', '$this->alname', '$this->aemail', '$this->arelation', '$this->aphone', '$this->event_date', '$this->event_type', NOW())");


                $this->sqlerror = $stmt->prepare;


                $stmt->execute();

                echo $this->sqlerror = $stmt->error;



                $inserted_id = $mysqli->insert_id;

                $stmt->close();

                $this->success = lang("WEBFORM_SUCCESS");
            }
        }
    }

}

?>