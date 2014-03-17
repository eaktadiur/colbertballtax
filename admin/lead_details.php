<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}
$leadId = $_GET['id'];

//Check if selected lead exists
/* if(!leadIdExists($leadId)){
  header("Location: leads.php"); die();
  } */
$leaddetails = fetchLeadDetails($leadId); //Fetch lead details

require_once("header.php");
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="account.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="leads.php">Events Training Details</a>
        </li>
    </ul>
</div>


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Events Training Details</h2>

        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <tbody>
                    <tr>
                        <td colspan="4"><strong>Franchisee Owner Information </strong></td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $leaddetails[0]['fname']; ?></td>
                        <td>Last Name</td>
                        <td><?php echo $leaddetails[0]['lname']; ?></td>
                    </tr>
                    <tr>
                        <td>Mailing Address </td>
                        <td><?php echo $leaddetails[0]['address']; ?></td>
                        <td>City/State/Zip </td>
                        <td><?php echo $leaddetails[0]['city_state_zip']; ?></td>
                    </tr>
                    <tr>
                        <td>Phone </td>
                        <td><?php echo $leaddetails[0]['phone']; ?></td>
                        <td>Cell Phone </td>
                        <td><?php echo $leaddetails[0]['mobile']; ?></td>
                    </tr>
                    <tr>
                        <td>Fax </td>
                        <td><?php echo $leaddetails[0]['fax']; ?></td>
                        <td>T-Shirt Size </td>
                        <td><?php echo $leaddetails[0]['tshirt_size']; ?></td>
                    </tr>
                    <tr>
                        <td>E-Mail Address: </td>
                        <td><?php echo $leaddetails[0]['email']; ?></td>
                        <td>Event Type:</td>
                        <td><?php echo $leaddetails[0]['event_type']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4"><strong>Attendee Information </strong></td>
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
                        <td>Relation </td>
                        <td><?php echo $leaddetails[0]['arelation']; ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo $leaddetails[0]['aphone']; ?></td>
                        <td>T-Shirt Size</td>
                        <td><?php echo $leaddetails[0]['atshirt_size']; ?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Date Submitted</td>
                        <td><?php echo date("j M, Y", $leaddetails[0]['date']); ?></td>
                        <td></td>
                        <td></td>
                    </tr>


                </tbody>
            </table>            
            <p><a class="btn btn-info" href="lead_edit.php?id=<?php echo $leaddetails[0]['id'] ?>">
                    <i class="icon-edit icon-white"></i>  
                    Edit                                            
                </a></p>
        </div>
    </div><!--/span-->

</div>	

<?php include('footer.php'); ?>
</body>
</html>