<?php include_once ('parts/top.php');
include_once('../parts/help_functions.php');

$result = shell_exec('cut -d : -f 1 /etc/passwd');
$result = split("\n", $result);

?>

	<div id="wrapper">

		<?php include_once ('parts/nav.php');?>
		<div id="page-wrapper">	
			<div class="container-fluid">
				<form class="form-horizontal" role="form">
						<input id="page" type="hidden" name="page" value="remove_user">
						<div class="form-group">
							<label for="inputCommand" class="col-sm-1 control-label">Users: </label>
						</div>
						
						<div class="col-sm-3">
							<select name="option" class="form-ontrol">
								<?php foreach($result as $value) { 
									if ($value == '') {
										continue;
									}
								?>
									<option value="<?php echo($value); ?>"><?php echo($value); ?></option>
								<?php } ?>
							</select>
						</div>
								
				</form>
					
				<div id="respond" class="result-div"></div>	
			</div>
		</div>
		
		<script src="js/admin_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>