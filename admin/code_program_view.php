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
if ($_POST['delete']) {
    $deletions = $_POST['delete'];
    if ($deletion_count = deleteFranchise($deletions)) {
        $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
    } else {
        $errors[] = lang("SQL_ERROR");
    }
}

$leadsCard = allCardProgram(); //Fetch information for all Franchise

require_once("header.php");
?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="account.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="leads.php">Card Program</a>
        </li>
    </ul>
</div>


<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Card Program Listing</h2>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form name='leadsCard' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="leadsCard">

                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>City/State/Zip</th>
                            <th>Home Phone</th>
                            <th>Cell Phone</th>
                            <th>Email</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        foreach ($leadsCard as $v1) {

                            echo "
                                <tr>
                                <td><input type='checkbox' name='delete[" . $v1['card_program_id'] . "]' id='delete[" . $v1['card_program_id'] . "]' value='" . $v1['card_program_id'] . "'></td>
                                <td><a href='card_program_details.php?id=" . $v1['card_program_id'] . "'>" . $v1['company_name'] . "</a></td>
                                <td>" . $v1['address'] . "</td>
                                <td>" . $v1['city'] . '/' . $v1['state'] . '/' . $v1['zip'] . "</td>
                                <td>" . $v1['home_phone'] . "</td>
                                <td>" . $v1['cell_phone'] . "</td>
                                <td>" . $v1['email'] . "</td>
                                <td>" . $v1['total'] . "</td>
                                <td class='center' nowrap>
                                <a class='btn btn-success' href='card_program_details.php?id=" . $v1['card_program_id'] . "'>
                                        <i class='icon-zoom-in icon-white'></i>  
                                        View                                            
                                </a>
                                <a class='btn btn-info' href='card_program_edit.php?id=" . $v1['card_program_id'] . "'>
                                        <i class='icon-edit icon-white'></i>  
                                        Edit                                            
                                </a>
                        </td>
                                </tr>";
                        }
                        ?>


                    </tbody>

                </table> 
                <br>
                <div class="form-actions">
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="document.getElementById('leadsCard').submit();">
                        <i class="icon-trash icon-white"></i> 
                        Delete
                    </a>
                    <a class="btn btn-primary" href="export-xls.php?ex=franchisee">
                        <i class="icon icon-white icon-xls"></i> 
                        Export to Excel
                    </a>
                </div> 
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('footer.php'); ?>
