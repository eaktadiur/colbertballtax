<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("admin/models/config.php");
if (!$loggedInUser->user_id) {
    die();
}



$leadId = $loggedInUser->user_id;



//Check if selected lead exists
/* if(!leadIdExists($leadId)){
  header("Location: leads.php"); die();
  } */
$leaddetails = fetchFranchisedetails($leadId); //Fetch lead details
include('header.php');
?>




<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post"  enctype="multipart/form-data">
    <table class="table table-striped table-bordered  ">
        <tbody>

            <tr>
                <td colspan="1">Name</td>
                <td colspan="1"><input name="name" type="text" class="input-xlarge focused" id="name" value="<?php echo $cardDetails[0]['name']; ?>" /></td>

            </tr>
            <tr>
                <td nowrap="nowrap">Email</td>
                <td colspan="1"><input name="email" type="text" class="input-xlarge focused" id="email" value="<?php echo $cardDetails[0]['email']; ?>"  /></td>
            </tr>
            <tr>
                <td>Contact No</td>
                <td><input name="city" type="text" class="input-xlarge focused" id="city" value="<?php echo $cardDetails[0]['city']; ?>" /></td>

            </tr>
            <tr>
                <td>Shipping Address </td>
                <td ><input name="shipping_phone" type="text" class="input-xlarge focused" id="home_phone" value="<?php echo $cardDetails[0]['shipping_phone']; ?>" /></td>
            </tr>
            <tr>
                <td>Gift Cups </td>
                <td>
                    <select name="gift_cup">

                        <option value="" >Please Select Quantity</option>
                        <option value="100" >100 cups -- $100.00</option>
                        <option value="200" >200 cups -- $200.00</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Employee </td>
                <td>
                    <select name="employee">

                        <option value="" >Please Select Quantity</option>
                        <option value="100" >100 cups -- $100.00</option>
                        <option value="200" >200 cups -- $200.00</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Shirts </td>
                <td>
                    <select name="employee">

                        <option value="" >Please Select Quantity</option>
                        <option value="100" >100 cups -- $100.00</option>
                        <option value="200" >200 cups -- $200.00</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table" >
                        <thead>
                        <th width="200"></th>
                        <th width="50">Sm</th>
                        <th width="50">Med</th>
                        <th width="50">Large</th>
                        <th width="100">XL + $4 pet set</th>
                        <th width="100">XXL + $4 pet set</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>First 2 shirts</td>
                                <td><input  type="radio" name="sex" value="1"></td>
                                <td><input type="radio" name="sex" value="2"></td>
                                <td><input type="radio" name="sex" value="3"></td>
                                <td><input type="radio" name="sex" value="4"></td>
                                <td><input type="radio" name="sex" value="5"></td>

                            </tr>
                            <tr>
                                <td>First 2 shirts</td>
                                <td><input type="radio" name="sex1" value="1"></td>
                                <td><input type="radio" name="sex1" value="2"></td>
                                <td><input type="radio" name="sex1" value="3"></td>
                                <td><input type="radio" name="sex1" value="4"></td>
                                <td><input type="radio" name="sex1" value="5"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table> 

    <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary">
            <input type="radio" name="options" id="option1"> Option 1
        </label>
        <label class="btn btn-primary">
            <input type="radio" name="options" id="option2"> Option 2
        </label>
        <label class="btn btn-primary">
            <input type="radio" name="options" id="option3"> Option 3
        </label>
    </div>
<div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary">
            <input type="radio" name='Option' value='1' />Option 1</label>
    </div>

</form>

<?php include('footer.php'); ?>
