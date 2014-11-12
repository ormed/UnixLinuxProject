<?php include_once ('parts/top.php');?>

	<div id="wrapper">

		<?php include_once ('parts/nav.php');?>
		<div id="page-wrapper">
			<div class="container-fluid">
				<form class="form-horizontal" role="form">
						<input id="page" type="hidden" name="page" value="remove_user">
						<div class="form-group">
							<label for="inputCommand" class="col-sm-1 control-label">Users: </label>
						</div>
				</form>
					
				<div id="respond" class="result-div"></div>	
			</div>
		</div>
		
		<script src="js/admin_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>