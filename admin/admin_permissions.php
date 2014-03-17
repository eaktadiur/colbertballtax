<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}


require_once("header.php");



?>
<div>
				<ul class="breadcrumb">
					<li>
						<a href="account.php">Home</a> <span class="divider">/</span>
					</li>
					
				</ul>
			</div>


        <div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-user"></i> Coming Soon</h2>
						
					</div>
					<div class="box-content">
                    <?php echo resultBlock($errors,$successes); ?>
						            
					</div>
				</div><!--/span-->
			
			</div>	
    
<?php include('footer.php'); ?>
   </body>
</html>