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

<style type="text/css">
    body {
        padding-bottom: 40px;
    }
    .sidebar-nav {
        padding: 9px 0;
    }
    .overlay-bg {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        height:100%;
        width: 100%;
        cursor: pointer;
        background: #000; /* fallback */
        background: rgba(0,0,0,0.75);
    }
    .overlay-content {
        background: #fff;
        padding: 1%;
        width: 40%;
        position: relative;
        top: 15%;
        left: 50%;
        margin: 0 0 0 -20%; /* add negative left margin for half the width to center the div */
        cursor: default;
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0,0,0,0.9);
    }

</style>

<!-- jQuery -->
<?php if ($leaddetails[0]['active'] == 0) { ?>
    <script>
        $(document).ready(function() {
            // show popup when you click on the link
            $('.overlay-content').html($('.active-button').html());
            $('.overlay-bg').show(); //display your popup




        });
    </script>
<?php } ?>


<?php echo resultBlock($errors, $successes); ?>

<div class="overlay-bg">
    <div class="overlay-content"></div>
</div>
<div class="active-button">
    <form action="active.php" method="post"  >
        <p ><?php
            if ($leaddetails[0]['active'] == 0)
                echo '<button type="submit" class="btn btn-primary" name="activate">Activate My Account</button>';
            else
                echo '<button type="submit" class="btn btn-primary" name="activate">Deactivate My Account</button>';
            ?> </p>
        <input type="hidden" name="active" value="<?php echo $leaddetails[0]['active']; ?>">
        <input type="hidden" name="id" value="<?php echo $leaddetails[0]['id']; ?>">
    </form>
</div>
<?php include('admin/fran_edit.php'); ?>
<!--/row-->

<!--/row-->

<!-- content ends -->



<?php include('footer.php'); ?>
