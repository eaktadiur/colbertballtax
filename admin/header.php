<?php
require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])) {
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>Colbert/Ball Tax Services</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Muhammad Usman">

        <!-- The styles -->
        <link id="bs-css" href="../css/bootstrap-redy.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }

            .form-actions {
                padding: 17px 20px 18px;
                margin-top: 38px;
                margin-bottom: 18px;
                background-color: #f5f5f5;
                border-top: 1px solid #e5e5e5;
                *zoom: 1;
            }

            .pagination {
                height: 36px;
                margin: 0px 0;
            }
        </style>
        <link href="../css/bootstrap-responsive.css" rel="stylesheet">
        <link href="../css/charisma-app.css" rel="stylesheet">
        <link href="../css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
        <link href='../css/fullcalendar.css' rel='stylesheet'>
        <link href='../css/fullcalendar.print.css' rel='stylesheet'  media='print'>
        <link href='../css/chosen.css' rel='stylesheet'>
        <link href='../css/uniform.default.css' rel='stylesheet'>
        <link href='../css/colorbox.css' rel='stylesheet'>
        <link href='../css/jquery.cleditor.css' rel='stylesheet'>
        <link href='../css/jquery.noty.css' rel='stylesheet'>
        <link href='../css/noty_theme_default.css' rel='stylesheet'>
        <link href='../css/elfinder.min.css' rel='stylesheet'>
        <link href='../css/elfinder.theme.css' rel='stylesheet'>
        <link href='../css/jquery.iphone.toggle.css' rel='stylesheet'>
        <link href='../css/opa-icons.css' rel='stylesheet'>
        <link href='../css/uploadify.css' rel='stylesheet'>

        <link href='../DataTables-1.9.4/media/css/jquery.dataTables.css' rel='stylesheet'>
        <link href='../DataTables-1.9.4/extras/TableTools/media/css/TableTools.css' rel='stylesheet'>


        <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- The fav icon -->
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="../js/jquery-1.7.2.min.js"></script>
    </head>

    <body>
        <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
            <!-- topbar starts -->
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="brand" href="account.php"> <img alt="Colbert/Ball Tax Services" src="../images/logo.png" /></a>


                        <!-- user dropdown starts -->
                        <div class="btn-group pull-right" >
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i><span class="hidden-phone"> <?php echo $loggedInUser->displayname ?></span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="user_settings.php">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <!-- user dropdown ends -->


                    </div>
                </div>
            </div>
            <!-- topbar ends -->
        <?php } ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

                    <!-- left menu starts -->
                    <div class="span2 main-menu-span">
                        <div class="well nav-collapse sidebar-nav">
                            <?php if (isUserLoggedIn()) { ?>
                                <ul class="nav nav-tabs nav-stacked main-menu">
                                    <li class="nav-header hidden-tablet">Main</li>
                                    <li><a class="ajax-link" href="account.php"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                                    <li><a class="ajax-link" href="user_settings.php"><i class="icon-user"></i><span class="hidden-tablet"> Profile</span></a></li>
                                    <li><a class="ajax-link" href="leads.php"><i class="icon-th-list"></i><span class="hidden-tablet"> Events Training</span></a></li>			
                                    <li><a class="ajax-link" href="franchisee.php"><i class="icon-th-list"></i><span class="hidden-tablet"> Franchisee</span></a></li>			

                                    <?php if ($loggedInUser->checkPermission(array(2))) { ?>
                                        <li><a class="ajax-link" href="admin_users.php"><i class="icon icon-darkgray icon-users"></i><span class="hidden-tablet"> Users</span></a></li>
                                        <li><a class="ajax-link" href="admin_users_add.php"><i class=" icon-plus-sign"></i><span class="hidden-tablet"> Add User</span></a></li>
                                        <li><a href="admin_configuration.php"><i class="icon-wrench"></i><span class="hidden-tablet"> Admin Configuration</span></a></li>
                                        <li><a class="ajax-link" href="admin_permissions.php"><i class="icon-lock"></i><span class="hidden-tablet"> Admin Permissions</span></a></li>
                                        <li><a href="admin_pages.php"><i class="icon-book"></i><span class="hidden-tablet"> Admin Pages</span></a></li>
                                    <?php } ?>
                                    <li><a href="logout.php"><i class="icon-off"></i><span class="hidden-tablet"> Logout</span></a></li>
                                </ul>
                            <?php } ?>
                        </div><!--/.well -->
                    </div><!--/span-->
                    <!-- left menu ends -->

                    <noscript>
                    <div class="alert alert-block span10">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                    </div>
                    </noscript>

                    <div id="content" class="span10">
                        <!-- content starts -->
                    <?php } ?>
