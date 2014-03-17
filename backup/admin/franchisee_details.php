<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$leadId = $_GET['id'];

//Check if selected lead exists
if(!franchiseIdExists($leadId)){
	header("Location: franchisee.php"); die();
}
$leaddetails = fetchFranchiseDetails($leadId); //Fetch lead details
$comments = fetchComments($leadId); //Fetch comments details

require_once("header.php");



?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#comments').submit(function(e){
			e.preventDefault();
			$.ajax({type:'POST', url: 'add_comment.php', data:$('#comments').serialize(), success: function(response) {
				$('#fran_detail_table tr:last').before('<tr><td colspan="4">'+ response +'</td></tr>');
			$('#comments')[0].reset();
			}});
	
			return false;
		});
	});
</script>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="account.php">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="leads.php">Franchisee Details</a>
					</li>
				</ul>
			</div>


        <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Franchisee Details</h2>
						
					</div>
					<div class="box-content">
                    <?php echo resultBlock($errors,$successes); ?>
						<table class="table table-striped table-bordered " id="fran_detail_table">
						   <tbody>
                          <tr>
                            <td colspan="4"><strong>Franchisee Owner Information </strong></td>
                            </tr>
                          <tr>
                          	<td>First Name</td>
                            <td><?php echo $leaddetails[0]['fname']; ?> <?php if ($leaddetails[0]['active'] == 0) echo '<span class="label label-inverse">Inactive</span>'; else echo'<span class="label label-success">Active</span>';?></td>
                            <td>Last Name</td>
                            <td><?php echo $leaddetails[0]['lname']; ?></td>
                          </tr>
                          <tr>
                            <td>Social Security EFIN </td>
                            <td><?php echo $leaddetails[0]['ssefin']; ?></td>
                            <td>E-Mail Address</td>
                            <td><?php echo $leaddetails[0]['email']; ?></td>
                          </tr>
                          <tr>
                            <td>Primary Phone Business </td>
                            <td><?php echo $leaddetails[0]['phone_business']; ?></td>
                            <td> Phone </td>
                            <td><?php echo $leaddetails[0]['phone']; ?></td>
                          </tr>
                          <tr>
                            <td>Home Phone </td>
                            <td><?php echo $leaddetails[0]['home_phone']; ?></td>
                            <td>Fax </td>
                            <td><?php echo $leaddetails[0]['fax']; ?></td>
                          </tr>
                          <tr>
                            <td>Mailing Address </td>
                            <td><?php echo $leaddetails[0]['address']; ?></td>
                            <td>City/State/Zip</td>
                            <td><?php echo $leaddetails[0]['city_state_zip']  ?></td>
                          </tr>
                         <tr>
                            <td>Developer  Bank Product </td>
                            <td><?php echo $leaddetails[0]['developer_bank']; ?></td>
                            <td>Software</td>
                            <td><?php echo $leaddetails[0]['software']  ?></td>
                          </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Partner  Information</strong></td>
                            </tr>
                          <tr>
                            <td>First Name </td>
                            <td><?php echo $leaddetails[0]['afname']; ?></td>
                            <td>First Name </td>
                            <td><?php echo $leaddetails[0]['alname']; ?></td>
                          </tr>
                          <tr>
                            <td>E-Mail Address </td>
                            <td><?php echo $leaddetails[0]['aemail']; ?></td>
                            <td>Primary Phone </td>
                            <td><?php echo $leaddetails[0]['primary_phone']; ?></td>
                          </tr>
                          <tr>
                            <td>Business Phone</td>
                            <td><?php echo $leaddetails[0]['aphone']; ?></td>
                            <td>Fax</td>
                            <td><?php echo $leaddetails[0]['afax']; ?></td>
                          </tr>
                          <tr>
                            <td>City/State/Zip</td>
                            <td><?php echo $leaddetails[0]['acity_state_zip']; ?></td>
                            <td>Document Upload(EFIN letter)</td>
                            <td><a href="<?php echo BACK_ROOT."upload/".$leaddetails[0]['file']?>" target="_blank"><?php echo $leaddetails[0]['file']; ?></a></td>
                          </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Location   Information</strong></td>
                            </tr>
                          <tr>
                            <td>Location Address </td>
                            <td><?php echo $leaddetails[0]['laddress']; ?></td>
                            <td>Store Category </td>
                            <td><?php echo $leaddetails[0]['lstore']; ?></td>
                          </tr>
                          <tr>
                            <td>Store Type </td>
                            <td><?php echo $leaddetails[0]['lstore_type']; ?></td>
                            <td>City/State/Zip </td>
                            <td><?php echo $leaddetails[0]['lcity_state_zip']; ?></td>
                          </tr>
                          <tr>
                            <td>Email</td>
                            <td><?php echo $leaddetails[0]['lemail']; ?></td>
                            <td>Website</td>
                            <td><?php echo $leaddetails[0]['lwebsite']; ?></td>
                          </tr>
                          <tr>
                            <td>Primary Phone </td>
                            <td><?php echo $leaddetails[0]['lphone']; ?></td>
                            <td>Secondary Phone</td>
                            <td><?php echo $leaddetails[0]['lphone2']; ?></td>
                          </tr>
                           <tr>
                            <td>Fax</td>
                            <td><?php echo $leaddetails[0]['lfax']; ?></td>
                            <td></td>
                            <td></td>
                          </tr>
                                <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td>Date </td>
                            <td><?php if ($leaddetails[0]['date']) echo date("j M, Y", $leaddetails[0]['date']); ?></td>
                            <td>Date Modified </td>
                            <td><?php if ($leaddetails[0]['date_modified']) echo date("j M, Y", $leaddetails[0]['date_modified']); ?></td>
                          </tr>
                          <tr>
                            <td colspan="4">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="4"><strong>Comments</strong></td>
                          </tr>
                          <?php foreach ($comments as $comment) {?>
                          <tr>
                            <td colspan="4"><?php 
								echo $comment['comments']."<br ><strong>".$comment['display_name']."</strong> [ ".date("j M, Y", $comment['date'])." ]";
								
								
							?></td>
                          </tr>   
                          <?php } ?>  
                          <tr>
                            <td colspan="4"><form id="comments" name="comments" method="post" action="add_comment.php">
                                <textarea name="comments" id="comments" cols="80" rows="5" style="width:80%"></textarea><br />
                                <button type="submit" class="btn btn-primary"  name="add_comment" id="add_comment">Add Comments</button>
                                <input type="hidden" name="franchise_id" value="<?php echo $leaddetails[0]['id']; ?>" />
                                <input type="hidden" name="user_id" value="<?php echo $loggedInUser->user_id; ?>" />
                            </form></td>
                            </tr>         
							
                          </tbody>
					  </table>            
                      <p><a class="btn btn-info" href="franchisee_edit.php?id=<?php echo $leaddetails[0]['id'] ?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a></p>
					</div>
				</div><!--/span-->
			
			</div>	
    
<?php include('footer.php'); ?>
   </body>
</html>