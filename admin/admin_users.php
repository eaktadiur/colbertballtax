<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$deletions = $_POST['delete'];
	if ($deletion_count = deleteUsers($deletions)){
		$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
	}
	else {
		$errors[] = lang("SQL_ERROR");
	}
}

$userData = fetchAllUsers(); //Fetch information for all users

require_once("header.php");

?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="account.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="leads.php">Users</a>
					</li>
				</ul>
			</div>


        <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Users</h2>
						
					</div>
					<div class="box-content">
                    <?php echo resultBlock($errors,$successes); ?>
                    <form name='adminUsers' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="adminUsers">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Delete</th>
								  <th>Username</th>
								  <th>Display Name	</th>
								  <th>Last Sign In</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php 
						  foreach ($userData as $v1) {
									echo "
									<tr>
									<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
									<td><a href='admin_user.php?id=".$v1['id']."'>".$v1['user_name']."</a></td>
									<td>".$v1['display_name']."</td>
									<td>
										";
										
										//Interprety last login
										if ($v1['last_sign_in_stamp'] == '0'){
											echo "Never";	
										}
										else {
											echo date("j M, Y", $v1['last_sign_in_stamp']);
										}
										echo "
	</td>
									<td class='center'>
									<a class='btn btn-success' href='#'>
										<i class='icon-zoom-in icon-white'></i>  
										View                                            
									</a>
									<a class='btn btn-info' href='#'>
										<i class='icon-edit icon-white'></i>  
										Edit                                            
									</a>
								</td>
									</tr>";
								}
						  ?>
							
							
						  </tbody>
					  </table>    
                      <div class="form-actions">
                                         <a class="btn btn-danger" href="javascript:void(0)" onclick="document.getElementById('adminUsers').submit();">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
                                          </div>
                                         </form>    
					</div>
				</div><!--/span-->
			
			</div>	
    
<?php include('footer.php'); ?>
   </body>
</html>