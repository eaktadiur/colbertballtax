<?php
/*
  UserCake Version: 2.0.2
  http://usercake.com
 */

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}
require_once("header.php");
?>


<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#home">Home</a></li>
    <li><a href="#profile">Profile</a></li>
    <li><a href="#messages">Messages</a></li>
    <li><a href="#settings">Settings</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="home">.home..</div>
    <div class="tab-pane" id="profile">.profile..</div>
    <div class="tab-pane" id="messages">.messages..</div>
    <div class="tab-pane" id="settings">.settings..</div>
</div>

<div id="content" class="span10">
    <!-- content starts -->


    <div>
        <ul class="breadcrumb">
            <li>
                <a href="account.php">Home</a> <span class="divider">/</span>
            </li>
            <li>
                <a href="account.php">Dashboard</a>
            </li>
        </ul>
    </div>
    <div class="sortable row-fluid">
        <a data-rel="tooltip" title="" class="well span3 top-block" href="leads.php">
            <span class="icon32 icon-red icon-user"></span>
            <div>Event Training</div>
            <div><?php echo TotalLead(); ?></div>

        </a>

        <a data-rel="tooltip" title="" class="well span3 top-block" href="franchisee.php">
            <span class="icon32 icon-red icon-user"></span>
            <div>Franchisee</div>
            <div><?php echo TotalFranchisee(); ?></div>

        </a>

        <a data-rel="tooltip" title="" class="well span3 top-block" href="admin_users.php">
            <span class="icon32 icon-color icon-star-on"></span>
            <div>Employees</div>
            <div><?php echo TotalEmployee(); ?></div>
        </a>


    </div>






    <!-- content ends -->
</div>
<?php include('footer.php'); ?>