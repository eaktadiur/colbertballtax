<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Colbert/Ball Tax Services</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-redy.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	  
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
    <script src="js/jquery-1.7.2.min.js"></script>
  
</head>

<body>
	
	
				
				
							
			<p align="center" style="background:url(images/header-bg.jpg)"><img src="images/cbr.jpg" alt="2013 New Franchise Training Registration Form" /></p>
				
				
	

	<div class="container-fluid">
    
		<div class="row-fluid">
	<?php if (isFranchiseLoggedIn() && !strpos($_SERVER['PHP_SELF'],'index.php')) {  ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
               
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Franchisee Tools</li>
						<li><a class="ajax-link" href="franchisee_edit.php"><i class="icon-user"></i><span class="hidden-tablet"> Profile Update</span></a></li>
                        <li><a class="ajax-link" href="download.php"><i class="icon-download-alt"></i><span class="hidden-tablet"> Downloads</span></a></li>
						<li><a class="ajax-link" href="email_request.php"><i class="icon-envelope"></i><span class="hidden-tablet"> Email Request</span></a></li>
						<li><a class="ajax-link" href="software-bank-information.php"><i class="icon-briefcase"></i><span class="hidden-tablet"> Software and Bank Information</span></a></li>			
                        <li><a class="ajax-link" href="databaseupdate.php"><i class="icon-filter"></i><span class="hidden-tablet"> Database Update</span></a></li>	
                        <li><a class="ajax-link" href="checks.php"><i class="icon-eye-close"></i><span class="hidden-tablet"> Check Stock Requests</span></a></li>	
                        <li><a class="ajax-link" href="marketing-materials.php"><i class="icon-folder-open"></i><span class="hidden-tablet"> Marketing Materials</span></a></li>	
                        <li><a class="ajax-link" href="mediabuypage.php"><i class="icon-facetime-video"></i><span class="hidden-tablet"> Media Buy</span></a></li>			
						
                       
						<li><a href="logout.php"><i class="icon-off"></i><span class="hidden-tablet"> Logout</span></a></li>
					</ul>

				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
<?php } ?>
            
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
            
			<div id="content" class="span10">
            
			<!-- content starts -->

