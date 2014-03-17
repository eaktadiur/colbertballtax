<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("admin/models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}


//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$username = sanitize(trim($_POST["email"]));
	$password = trim($_POST["effin"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!franchiseExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID").$username;
		}
		else
		{
			$userdetails = fetchFranchiseDetailsByEmail($username);
			//See if the user's account is activated
			
				//Hash the password and use the salt from the database to compare the password.
				//$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($password != $userdetails[0]["ssefin"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails[0]["email"];
					$loggedInUser->user_id = $userdetails[0]["id"];
					
					//Update last sign in
					//$loggedInUser->updateLastSignIn();
					$_SESSION["userCakeUser"] = $loggedInUser;
					
					
					//Redirect to user account page
						header("Location: franchisee_edit.php?id=".$loggedInUser->user_id);
						die();
				}
			}
		
	}
}

$no_visible_elements=true;
include('header.php'); ?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome to Colbert/Ball Tax Services</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						Please login with your Username and Password.
					</div>
                    <?php echo resultBlock($errors,$successes);?>
					<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						<fieldset>
							<div class="input-prepend" title="Email" data-rel="tooltip">
								Email&nbsp;
						  </div>
                            <div class="input-prepend" title="Email" data-rel="tooltip">
								<span class="add-on"><i class="icon-envelope"></i></span><input autofocus class="input-large span10" name="email" id="email" type="text" value="" />
						  </div>
							<div class="clearfix"></div>
                           

 <div class="input-prepend" title="Email" data-rel="tooltip">SSN# </div>
<div class="input-prepend" title="SSN#" data-rel="tooltip"><span class="add-on"><i class="icon-user"></i></span><input class="input-large span10" name="effin" id="effin" type="password" value="" /></div>
							<div class="clearfix"></div>

							
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
                            <button type="button" class="btn btn-primary" onclick="location.href='franchisee.php'">Register</button>
							</p>
                            <p></p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>
