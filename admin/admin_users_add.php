<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("models/config.php");

//print_r($_SERVER['PHP_SELF']);
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}
if (!$loggedInUser->checkPermission(array(2))) {
    die();
}
//Prevent the user visiting the logged in page if he/she is already logged in
//if(isUserLoggedIn()) { header("Location: account.php"); die(); }
//Forms posted
if (!empty($_POST)) {
    $errors = array();
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $displayname = trim($_POST["displayname"]);
    $password = trim($_POST["password"]);
    $confirm_pass = trim($_POST["passwordc"]);


    if (minMaxRange(5, 25, $username)) {
        $errors[] = lang("ACCOUNT_USER_CHAR_LIMIT", array(5, 25));
    }
    if (!ctype_alnum($username)) {
        $errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
    }
    if (minMaxRange(5, 25, $displayname)) {
        $errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT", array(5, 25));
    }
    if (!ctype_alnum($displayname)) {
        $errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
    }
    if (minMaxRange(8, 50, $password) && minMaxRange(8, 50, $confirm_pass)) {
        $errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT", array(8, 50));
    } else if ($password != $confirm_pass) {
        $errors[] = lang("ACCOUNT_PASS_MISMATCH");
    }
    if (!isValidEmail($email)) {
        $errors[] = lang("ACCOUNT_INVALID_EMAIL");
    }
    //End data validation
    if (count($errors) == 0) {
        //Construct a user object
        $user = new User($username, $displayname, $password, $email);

        //Checking this flag tells us whether there were any errors such as possible data duplication occured
        if (!$user->status) {
            if ($user->username_taken)
                $errors[] = lang("ACCOUNT_USERNAME_IN_USE", array($username));
            if ($user->displayname_taken)
                $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE", array($displayname));
            if ($user->email_taken)
                $errors[] = lang("ACCOUNT_EMAIL_IN_USE", array($email));
        }
        else {
            //Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
            if (!$user->userCakeAddUser()) {
                if ($user->mail_failure)
                    $errors[] = lang("MAIL_ERROR");
                if ($user->sql_failure)
                    $errors[] = lang("SQL_ERROR");
            }
        }
    }
    if (count($errors) == 0) {
        $successes[] = $user->success;
    }
}

require_once("header.php");
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="account.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="admin_users_add.php">Add User</a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> User Settings</h2>

        </div>
        <div class="box-content">
<?php echo resultBlock($errors, $successes); ?>
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="control-group">
                    <label class="control-label" for="focusedInput">User Name</label>
                    <div class="controls">
                        <input name="username" type="text" class="input-xlarge focused" id="username" value="">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Display Name</label>
                    <div class="controls">
                        <input name="displayname" type="text" class="input-xlarge focused" id="displayname" value="" >
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Password</label>
                    <div class="controls">
                        <input name="password" type="password" class="input-xlarge focused" id="password" value="">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Confirm Password</label>
                    <div class="controls">
                        <input name="passwordc" type="password" class="input-xlarge focused" id="passwordc" value="">
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="focusedInput">Email</label>
                    <div class="controls">
                        <input name="email" type="text" class="input-xlarge focused" id="email" value="">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
<?php include('footer.php'); ?>
</body>
</html>