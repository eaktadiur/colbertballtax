<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("admin/models/config.php");


//Forms posted
if (!empty($_POST)) {
    $errors = array();
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
    $dob = trim($_POST["dob"]);
    $marital_status = trim($_POST["marital_status"]);

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
    $adob = trim($_POST["adob"]);
    $amarital_status = trim($_POST["amarital_status"]);

    $laddress = trim($_POST["laddress"]);
    $lstore = trim($_POST["lstore"]);
    $lstore_type = trim($_POST["lstore_type"]);
    $lcity_state_zip = trim($_POST["lcity_state_zip"]);
    $lemail = trim($_POST["lemail"]);
    $lwebsite = trim($_POST["lwebsite"]);
    $lphone = trim($_POST["lphone"]);
    $lphone2 = trim($_POST["lphone2"]);
    $lfax = trim($_POST["lfax"]);
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


    $captcha = md5($_POST["captcha"]);

    if ($captcha != $_SESSION['captcha']) {
        $errors[] = lang("CAPTCHA_FAIL");
    }
    if ($fname == "") {
        $errors[] = lang("WEBFORM_SPECIFY_FIRST_NAME");
    }
    if ($lname == "") {
        $errors[] = lang("WEBFORM_SPECIFY_LAST_NAME");
    }
    if ($address == "") {
        $errors[] = lang("WEBFORM_SPECIFY_ADDRESS");
    }
    if ($city_state_zip == "") {
        $errors[] = lang("WEBFORM_SPECIFY_CITY_STATE_ZIP");
    }
    if ($phone == "") {
        $errors[] = lang("WEBFORM_SPECIFY_PHONE");
    }
    if ($email == "") {
        $errors[] = lang("WEBFORM_SPECIFY_EMAIL");
    }
    if (!isValidEmail($email)) {
        $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }
    if (!$files == "") {
        if (!isFileType($files)) {
            $errors[] = lang("FIlE_TYPE_NOT_SUPORTED");
        }
    }


    //End data validation
    if (count($errors) == 0) {


        if (!$files == "") {
            $allowedExts = array("jpg", "jpeg", "gif", "png", "doc", "docx", "txt", "rtf", "pdf", "xls", "xlsx", "ppt", "pptx", "pdf");
            $temp = explode(".", $_FILES["files"]["name"]);
            $extension = end($temp);
            if (in_array($extension, $allowedExts)) {
                if ($_FILES["files"]["error"] > 0)
                    $errors[] = $_FILES["file"]["error"];
                else {

                    $ran = rand();
                    if (file_exists("admin/upload/" . $ran . $_FILES["files"]["name"]))
                        $errors[] = $ran . $_FILES["files"]["name"] . " already exists. ";
                    else {
                        move_uploaded_file($_FILES["files"]["tmp_name"], "admin/upload/" . $ran . $_FILES["files"]["name"]);
                        $files = $ran . $_FILES["files"]["name"];
                    }
                }
            }
        }
        //Construct a user object
        $franchise = new franchise($fname, $lname, $ssefin, $email, $phone_business, $phone, $home_phone, $fax, $address, $city_state_zip, $developer_bank, $software, $afname, $alname, $aemail, $primary_phone, $aphone, $afax, $acity_state_zip, $files, $temp_name, $file_error, $laddress, $lstore, $lstore_type, $lcity_state_zip, $lemail, $lwebsite, $lphone, $lphone2, $lfax, $efin, $active_date, $developer, $dob, $marital_status, $adob, $amarital_status, $laddress2, $lstore2, $lstore_type2, $lcity_state_zip2, $lemail2, $lwebsite2, $lphonee2, $lphone22, $lfax2, $efin2, $active_date2, $developer2, $laddress3, $lstore3, $lstore_type3, $lcity_state_zip3, $lemail3, $lwebsite3, $lphone3, $lphone23, $lfax3, $efin3, $active_date3, $developer3
        );
        if (!$franchise->status) {
            //if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
            if ($franchise->ssefin_taken)
                $errors[] = lang("FRANCHISE_EFIN_IN_USE", array($ssefin));
            if ($franchise->email_taken)
                $errors[] = lang("ACCOUNT_EMAIL_IN_USE", array($email));
            if ($franchise->file_upload_fail)
                $errors[] = lang("FILE_UPLOAD_FAIL");
        }
        else {

            //Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
            if (!$franchise->AddFranchise()) {
                //if($lead->mail_failure) $errors[] = lang("MAIL_ERROR");
                if ($franchise->sql_failure)
                    $errors[] = lang("SQL_ERROR");
            }
        }
    }
    if (count($errors) == 0) {
        $successes[] = $franchise->success;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>Colbert/Ball Tax Services</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Muhammad Usman">

        <!-- The styles -->
        <link id="bs-css" href="css/bootstrap-redy.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/charisma-app.css" rel="stylesheet">
        <link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href='css/fullcalendar.css' rel='stylesheet'>
        <link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
        <link href='css/chosen.css' rel='stylesheet'>
        <link href='css/uniform.default.css' rel='stylesheet'>
        <link href='css/colorbox.css' rel='stylesheet'>
        <link href='css/jquery.cleditor.css' rel='stylesheet'>
        <link href='css/jquery.noty.css' rel='stylesheet'>
        <link href='css/noty_theme_default.css' rel='stylesheet'>
        <link href='css/elfinder.min.css' rel='stylesheet'>
        <link href='css/elfinder.theme.css' rel='stylesheet'>
        <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='css/opa-icons.css' rel='stylesheet'>
        <link href='css/uploadify.css' rel='stylesheet'>



        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->



        <!-- The fav icon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <style>
            .row-fluid .span8{

                display: block;
                float: none;
                width: 900px;
                min-height: 28px;
                margin-left: 2.564102564%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                -ms-box-sizing: border-box;
                box-sizing: border-box;
                margin:auto;}
            </style>
        </head>

        <body>
            <div class="container-fluid" >

            <div class="row-fluid">


                <noscript>
                <div class="alert alert-block span8">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>

                <div id="content" class="span8">
                    <p><img src="images/cbr.jpg" alt="2013 New Franchise Training Registration Form" /></p>
                    <p>Already register, log in here <button type="button" class="btn btn-primary" onclick="location.href = 'index.php'">Log In</button></p>
<?php echo resultBlock($errors, $successes); ?>
                    <div class="row-fluid sortable">
                        <div class="box span12">
<?php if (count($successes) == 0) { ?>
                                <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
                                    <div class="box-header well" data-original-title>
                                        <h2><i class="icon-edit"></i> Franchisee Information:</h2>
                                    </div>
                                    <div class="box-content">

                                        <fieldset>
                                            <div class="control-group">
                                                <label class="control-label" for="fname">First Name</label>
                                                <div class="controls">
                                                    <input name="fname" type="text" class="input-xlarge" id="fname" value="<?php echo $fname ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lname">Last Name</label>
                                                <div class="controls">
                                                    <input name="lname" type="text" class="input-xlarge" id="lname" value="<?php echo $lname ?>">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="ssefin">Social Security EFIN </label>
                                                <div class="controls">
                                                    <input name="ssefin" type="text" class="input-xlarge" id="ssefin" value="<?php echo $ssefin ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="email">E-Mail Address </label>
                                                <div class="controls">
                                                    <input name="email" type="text" class="input-xlarge" id="email" value="<?php echo $email ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="phone_business">Primary Phone Business </label>
                                                <div class="controls">
                                                    <input name="phone_business" type="text" class="input-xlarge" id="phone_business" value="<?php echo $phone_business ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="phone">Phone</label>
                                                <div class="controls">
                                                    <input name="phone" type="text" class="input-xlarge" id="phone" value="<?php echo $phone ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="home_phone">Home Phone</label>
                                                <div class="controls">
                                                    <input name="home_phone" type="text" class="input-xlarge" id="home_phone" value="<?php echo $home_phone ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="fax">Fax</label>
                                                <div class="controls">
                                                    <input name="fax" type="text" class="input-xlarge" id="fax" value="<?php echo $fax ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="address">Mailing Address</label>
                                                <div class="controls">
                                                    <input name="address" type="text" class="input-xlarge" id="address" value="<?php echo $address ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="city_state_zip">City/State/Zip</label>
                                                <div class="controls">
                                                    <input name="city_state_zip" type="text" class="input-xlarge" id="city_state_zip" value="<?php echo $city_state_zip ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="developer_bank">Developer  Bank Product</label>
                                                <div class="controls">
                                                    <select name="developer_bank" id="developer_bank">
                                                        <option>Select</option>
                                                        <option value="Republic Bank ">Republic Bank </option>
                                                        <option value="Refund Advantage">Refund Advantage</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="software">Software </label>
                                                <div class="controls">
                                                    <select name="software" id="software">
                                                        <option>Select</option>
                                                        <option value="Taxslayer">Taxslayer</option>
                                                        <option value="Drake">Drake</option>
                                                        <option value="Crosslink">Crosslink</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="dob">Birth Date </label>
                                                <div class="controls">
                                                    <input name="dob" type="text" class="input-xlarge" id="dob" value="<?php echo $dob ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="marital_status">Marital Status </label>
                                                <div class="controls">
                                                    <input name="marital_status" type="text" class="input-xlarge" id="marital_status" value="<?php echo $marital_status ?>">
                                                </div>
                                            </div>

                                        </fieldset>


                                    </div>



                                    <div class="box-header well" data-original-title>
                                        <h2><i class="icon-edit"></i> Partner  Information</h2>
                                    </div>
                                    <div class="box-content">

                                        <fieldset>
                                            <div class="control-group">
                                                <label class="control-label" for="afname">First Name</label>
                                                <div class="controls">
                                                    <input name="afname" type="text" class="input-xlarge" id="afname" value="<?php echo $afname ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="alname">Last Name</label>
                                                <div class="controls">
                                                    <input name="alname" type="text" class="input-xlarge" id="alname" value="<?php echo $alname ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="aemail">E-Mail Address</label>
                                                <div class="controls">
                                                    <input name="aemail" type="text" class="input-xlarge" id="aemail" value="<?php echo $aemail ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="primary_phone">Primary Phone  </label>
                                                <div class="controls">
                                                    <input name="primary_phone" type="text" class="input-xlarge" id="primary_phone" value="<?php echo $primary_phone ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="aphone">Business Phone </label>
                                                <div class="controls">
                                                    <input name="aphone" type="text" class="input-xlarge" id="aphone" value="<?php echo $aphone ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="afax">Fax</label>
                                                <div class="controls">
                                                    <input name="afax" type="text" class="input-xlarge" id="afax" value="<?php echo $afax ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="acity_state_zip">City/State/Zip</label>
                                                <div class="controls">
                                                    <input name="acity_state_zip" type="text" class="input-xlarge" id="acity_state_zip" value="<?php echo $city_state_zip ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="files">Document Upload(EFIN letter)</label>
                                                <div class="controls">
                                                    <div class="uploader">
                                                        <input name="files" type="file" class="input-xlarge" id="files" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="adob">Birth Date </label>
                                                <div class="controls">
                                                    <input name="adob" type="text" class="input-xlarge" id="adob" value="<?php echo $adob ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="amarital_status">Marital Status </label>
                                                <div class="controls">
                                                    <input name="amarital_status" type="text" class="input-xlarge" id="amarital_status" value="<?php echo $amarital_status ?>">
                                                </div>
                                            </div>


                                        </fieldset>


                                    </div>




                                    <div class="box-header well" data-original-title>
                                        <h2><i class="icon-edit"></i> Location   Information</h2>
                                    </div>
                                    <div class="box-content">
                                        <p><strong>1.</strong></p>
                                        <fieldset>
                                            <div class="control-group">
                                                <label class="control-label" for="laddress">Location Address</label>
                                                <div class="controls">
                                                    <input name="laddress" type="text" class="input-xlarge" id="laddress" value="<?php echo $laddress ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="efin">EFIN</label>
                                                <div class="controls">
                                                    <input name="efin" type="text" class="input-xlarge" id="efin" value="<?php echo $efin ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstore"> Store Category </label>
                                                <div class="controls">
                                                    <select name="lstore" id="lstore">
                                                        <option>Select</option>
                                                        <option value="Store">Store</option>
                                                        <option value="Kiosk ">Kiosk </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstore_type">Store Type</label>
                                                <div class="controls">
                                                    <select name="lstore_type" id="lstore_type">
                                                        <option>Select</option>
                                                        <option value="HEB">HEB</option>
                                                        <option value="Fiesta ">Fiesta </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lcity_state_zip">City/State/Zip</label>
                                                <div class="controls">
                                                    <input name="lcity_state_zip" type="text" class="input-xlarge" id="lcity_state_zip" value="<?php echo $lcity_state_zip ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lemail">Email </label>
                                                <div class="controls">
                                                    <input name="lemail" type="text" class="input-xlarge" id="lemail" value="<?php echo $lemail ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lwebsite">Website  </label>
                                                <div class="controls">
                                                    <input name="lwebsite" type="text" class="input-xlarge" id="lwebsite" value="<?php echo $lwebsite ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="lphone">Primary Phone </label>
                                                <div class="controls">
                                                    <input name="lphone" type="text" class="input-xlarge" id="lphone" value="<?php echo $lphone ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lphonee2">Secondary Phone </label>
                                                <div class="controls">
                                                    <input name="lphone2" type="text" class="input-xlarge" id="lphone2" value="<?php echo $lphone2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lfax">Fax </label>
                                                <div class="controls">
                                                    <input name="lfax" type="text" class="input-xlarge" id="lfax" value="<?php echo $lfax ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="active_date">Active Date </label>
                                                <div class="controls">
                                                    <input name="active_date" type="text" class="input-xlarge" id="active_date" value="<?php echo $active_date ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="developer">Developer </label>
                                                <div class="controls">
                                                    <input name="developer" type="text" class="input-xlarge" id="developer" value="<?php echo $developer ?>">
                                                </div>
                                            </div>





                                        </fieldset>


                                    </div>




                                    <div class="box-content">
                                        <p><strong>2.</strong></p>
                                        <fieldset>
                                            <div class="control-group">
                                                <label class="control-label" for="laddress2">Location Address</label>
                                                <div class="controls">
                                                    <input name="laddress2" type="text" class="input-xlarge" id="laddress2" value="<?php echo $laddress2 ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="efin2">EFIN</label>
                                                <div class="controls">
                                                    <input name="efin2" type="text" class="input-xlarge" id="efin2" value="<?php echo $efin2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstore2"> Store Category </label>
                                                <div class="controls">
                                                    <select name="lstore2" id="lstore2">
                                                        <option>Select</option>
                                                        <option value="Store">Store</option>
                                                        <option value="Kiosk ">Kiosk </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstore_type2">Store Type</label>
                                                <div class="controls">
                                                    <select name="lstore_type2" id="lstore_type2">
                                                        <option>Select</option>
                                                        <option value="HEB">HEB</option>
                                                        <option value="Fiesta ">Fiesta </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lcity_state_zip2">City/State/Zip</label>
                                                <div class="controls">
                                                    <input name="lcity_state_zip2" type="text" class="input-xlarge" id="lcity_state_zip2" value="<?php echo $lcity_state_zip2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lemail2">Email </label>
                                                <div class="controls">
                                                    <input name="lemail2" type="text" class="input-xlarge" id="lemail2" value="<?php echo $lemail2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lwebsite">Website  </label>
                                                <div class="controls">
                                                    <input name="lwebsite2" type="text" class="input-xlarge" id="lwebsite2" value="<?php echo $lwebsite2 ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="lphonee2">Primary Phone </label>
                                                <div class="controls">
                                                    <input name="lphonee2" type="text" class="input-xlarge2" id="lphonee2" value="<?php echo $lphonee2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lphone22">Secondary Phone </label>
                                                <div class="controls">
                                                    <input name="lphone22" type="text" class="input-xlarge" id="lphone22" value="<?php echo $lphone22 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lfax2">Fax </label>
                                                <div class="controls">
                                                    <input name="lfax2" type="text" class="input-xlarge" id="lfax2" value="<?php echo $lfax2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="active_date2">Active Date </label>
                                                <div class="controls">
                                                    <input name="active_date2" type="text" class="input-xlarge" id="active_date2" value="<?php echo $active_date2 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="developer2">Developer </label>
                                                <div class="controls">
                                                    <input name="developer2" type="text" class="input-xlarge" id="developer2" value="<?php echo $developer2 ?>">
                                                </div>
                                            </div>





                                        </fieldset>


                                    </div>





                                    <div class="box-content">
                                        <p><strong>3.</strong></p>
                                        <fieldset>
                                            <div class="control-group">
                                                <label class="control-label" for="laddress3">Location Address</label>
                                                <div class="controls">
                                                    <input name="laddress3" type="text" class="input-xlarge" id="laddress3" value="<?php echo $laddress3 ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="efin3">EFIN</label>
                                                <div class="controls">
                                                    <input name="efin3" type="text" class="input-xlarge" id="efin3" value="<?php echo $efin3 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstore3"> Store Category </label>
                                                <div class="controls">
                                                    <select name="lstore3" id="lstore3">
                                                        <option>Select</option>
                                                        <option value="Store">Store</option>
                                                        <option value="Kiosk ">Kiosk </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lstore_type3">Store Type</label>
                                                <div class="controls">
                                                    <select name="lstore_type3" id="lstore_type3">
                                                        <option>Select</option>
                                                        <option value="HEB">HEB</option>
                                                        <option value="Fiesta ">Fiesta </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lcity_state_zip3">City/State/Zip</label>
                                                <div class="controls">
                                                    <input name="lcity_state_zip3" type="text" class="input-xlarge" id="lcity_state_zip3" value="<?php echo $lcity_state_zip3 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lemail3">Email </label>
                                                <div class="controls">
                                                    <input name="lemail3" type="text" class="input-xlarge" id="lemail3" value="<?php echo $lemail3 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lwebsite">Website  </label>
                                                <div class="controls">
                                                    <input name="lwebsite3" type="text" class="input-xlarge" id="lwebsite3" value="<?php echo $lwebsite3 ?>">
                                                </div>
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="lphone3">Primary Phone </label>
                                                <div class="controls">
                                                    <input name="lphone3" type="text" class="input-xlarge" id="lphone3" value="<?php echo $lphone3 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lphone23">Secondary Phone </label>
                                                <div class="controls">
                                                    <input name="lphone23" type="text" class="input-xlarge" id="lphone23" value="<?php echo $lphone23 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="lfax3">Fax </label>
                                                <div class="controls">
                                                    <input name="lfax3" type="text" class="input-xlarge" id="lfax3" value="<?php echo $lfax3 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="active_date3">Active Date </label>
                                                <div class="controls">
                                                    <input name="active_date3" type="text" class="input-xlarge" id="active_date3" value="<?php echo $active_date3 ?>">
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="developer3">Developer </label>
                                                <div class="controls">
                                                    <input name="developer3" type="text" class="input-xlarge" id="developer3" value="<?php echo $developer3 ?>">
                                                </div>
                                            </div>




                                        </fieldset>


                                    </div>



                                    <div class="box-header well" data-original-title>
                                        <h2><i class="icon-edit"></i> Security Code</h2>
                                    </div>
                                    <div class="box-content">

                                        <fieldset>

                                            <div class="control-group">
                                                <label class="control-label" for="alname">Security Code</label>
                                                <div class="controls">
                                                    <img src='admin/models/captcha.php'>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="alname">Enter Security Code</label>
                                                <div class="controls">
                                                    <input name='captcha' type='text' class="input-xlarge">
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                <button class="btn">Cancel</button>

                                            </div>
                                        </fieldset>


                                    </div>
                                </form>
<?php } ?>
                        </div><!--/span-->

                    </div><!--/row-->

                    <!--/row-->

                    <!-- content ends -->
                </div><!--/#content.span10-->
            </div><!--/fluid-row-->

            <hr>

            <div class="modal hide fade" id="myModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>


        <!-- external javascript
             ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <!-- jQuery -->
        <script src="js/jquery-1.7.2.min.js"></script>
        <!-- jQuery UI -->
        <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
        <!-- transition / effect library -->
        <script src="js/bootstrap-transition.js"></script>
        <!-- alert enhancer library -->
        <script src="js/bootstrap-alert.js"></script>
        <!-- modal / dialog library -->
        <script src="js/bootstrap-modal.js"></script>
        <!-- custom dropdown library -->
        <script src="js/bootstrap-dropdown.js"></script>
        <!-- scrolspy library -->
        <script src="js/bootstrap-scrollspy.js"></script>
        <!-- library for creating tabs -->
        <script src="js/bootstrap-tab.js"></script>
        <!-- library for advanced tooltip -->
        <script src="js/bootstrap-tooltip.js"></script>
        <!-- popover effect library -->
        <script src="js/bootstrap-popover.js"></script>
        <!-- button enhancer library -->
        <script src="js/bootstrap-button.js"></script>
        <!-- accordion library (optional, not used in demo) -->
        <script src="js/bootstrap-collapse.js"></script>
        <!-- carousel slideshow library (optional, not used in demo) -->
        <script src="js/bootstrap-carousel.js"></script>
        <!-- autocomplete library -->
        <script src="js/bootstrap-typeahead.js"></script>
        <!-- tour library -->
        <script src="js/bootstrap-tour.js"></script>
        <!-- library for cookie management -->
        <script src="js/jquery.cookie.js"></script>
        <!-- calander plugin -->
        <script src='js/fullcalendar.min.js'></script>
        <!-- data table plugin -->
        <script src='js/jquery.dataTables.min.js'></script>

        <!-- chart libraries start -->
        <script src="js/excanvas.js"></script>
        <script src="js/jquery.flot.min.js"></script>
        <script src="js/jquery.flot.pie.min.js"></script>
        <script src="js/jquery.flot.stack.js"></script>
        <script src="js/jquery.flot.resize.min.js"></script>
        <!-- chart libraries end -->

        <!-- select or dropdown enhancer -->
        <script src="js/jquery.chosen.min.js"></script>
        <!-- checkbox, radio, and file input styler -->
        <script src="js/jquery.uniform.min.js"></script>
        <!-- plugin for gallery image view -->
        <script src="js/jquery.colorbox.min.js"></script>
        <!-- rich text editor library -->
        <script src="js/jquery.cleditor.min.js"></script>
        <!-- notification plugin -->
        <script src="js/jquery.noty.js"></script>
        <!-- file manager library -->
        <script src="js/jquery.elfinder.min.js"></script>
        <!-- star rating plugin -->
        <script src="js/jquery.raty.min.js"></script>
        <!-- for iOS style toggle switch -->
        <script src="js/jquery.iphone.toggle.js"></script>
        <!-- autogrowing textarea plugin -->
        <script src="js/jquery.autogrow-textarea.js"></script>
        <!-- multiple file upload plugin -->
        <script src="js/jquery.uploadify-3.1.min.js"></script>
        <!-- history.js for cross-browser state change on ajax -->
        <script src="js/jquery.history.js"></script>
        <!-- application script for Charisma demo -->
        <script src="js/charisma.js"></script>


    </body>
</html>
