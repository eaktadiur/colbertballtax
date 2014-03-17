<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}

//Forms posted
if (!empty($_POST)) {
    $deletions = $_POST['delete'];
    if ($deletion_count = deleteLeads($deletions)) {
        $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
    } else {
        $errors[] = lang("SQL_ERROR");
    }
}

$leads = fetchAllLeads(); //Fetch information for all leads

require_once("header.php");

?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="account.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="leads.php">Events Training</a>
        </li>
    </ul>
</div>


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Events Training</h2>
        </div>
        <div class="box-content">
<?php echo resultBlock($errors, $successes); ?>
            <form name='leads' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="leads">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>City/State/Zip</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Event Type</th>
                            <th width="130">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>
<?php
foreach ($leads as $v1) {
    echo "<tr>
                                    <td><input type='checkbox' name='delete[" . $v1['id'] . "]' id='delete[" . $v1['id'] . "]' value='" . $v1['id'] . "'></td>
                                    <td><a href='lead_details.php?id=" . $v1['id'] . "'>" . $v1['fname'] . " " . $v1['lname'] . "</a></td>
                                    <td>" . $v1['city_state_zip'] . "</td>
                                    <td>" . $v1['phone'] . "</td>
                                    <td>" . $v1['email'] . "</td>
                                    <td>" . $v1['event_type'] . "</td>
                                    <td class='center'>
                                    <a class='btn-success' href='lead_details.php?id=" . $v1['id'] . "'>
                                            <i class='icon-zoom-in icon-white'></i>  
                                            View                                            
                                    </a>
                                    <a class='btn btn-info' href='lead_edit.php?id=" . $v1['id'] . "'>
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
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="document.getElementById('leads').submit();">
                        <i class="icon-trash icon-white"></i> 
                        Delete
                    </a>
                    <a class="btn btn-primary" href="export-xls.php?ex=leads">
                        <i class="icon icon-white icon-xls"></i> 
                        Export to Excel
                    </a>
                </div>  
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('footer.php'); ?>