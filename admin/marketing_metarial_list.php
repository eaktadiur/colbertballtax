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
//print_r($deletions); die();
    if ($deletion_count = deleteMarketingMaterialRows($deletions)) {
        $successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL_MARKETING_MATERIALS", array($deletion_count));
    } else {
        $errors[] = lang("SQL_ERROR");
    }
}
$leadsMaterial = allMarketingMaterial(); //Fetch information for all Franchise
require_once("header.php");
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="account.php">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="leads.php">Marketing Materials</a>
        </li>
    </ul>
</div>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Marketing Materials Listing</h2>
        </div>
        <div class="box-content">
            <?php echo resultBlock($errors, $successes); ?>
            <form name='leadsMaterial' action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post' id="leadsMaterial">

                <table class="table table-striped table-bordered bootstrap-datatable datatable" id="franchise_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Material Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Shipping Address</th>
                            <th>Gift Cup QTY</th>
                            <th>Employee QTY</th>
                            <th>Shirt QTY</th>
                            <th>Balloon/Button QTY</th>
                            <th>Banner QTY</th>
                            <th>Action</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        foreach ($leadsMaterial as $v2) {

                            echo "
                                <tr>
                                <td><input type='checkbox' name='delete[" . $v2['marketing_materials_id'] . "]' id='delete[" . $v2['marketing_materials_id'] . "]' value='" . $v2['marketing_materials_id'] . "'></td>
                                <td><a href='marketing_materials_details.php?id=" . $v2['marketing_materials_id'] . "'>" . $v2['marketing_materials_name'] . "</a></td>
                                <td>" . $v2['marketing_materials_email'] . "</td>
                                <td>" . $v2['contact_no'] . "</td>
                                <td>" . $v2['shipping_address'] . "</td>
                                <td>" . $v2['gift_cup_name'] . "</td>
                                <td>" . $v2['employee_qty_name'] . "</td>
                                <td>" . $v2['shirt_tqy_name'] . "</td>
                                <td>" . $v2['balloons_button_qty_name'] . "</td>
                                <td>" . $v2['banner_qty_name'] . "</td>
                                <td class='center' nowrap>
                                <a class='btn btn-success' href='marketing_materials_details.php?id=" . $v2['marketing_materials_id'] . "'>
                                          
                                        View                                            
                                </a>
                                <a class='btn btn-info' href='marketing_materials_edit.php?id=" . $v2['marketing_materials_id'] . "'>
                                       
                                        Edit                                            
                                </a>
                        </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>     
                <div class="form-actions">
                    <a class="btn btn-danger" href="javascript:void(0)" onclick="document.getElementById('leadsMaterial').submit();">
                        <i class="icon-trash icon-white"></i> 
                        Delete
                    </a>

                </div> 
            </form>    
        </div>
    </div><!--/span-->

</div>	

<?php include('footer.php'); ?>
