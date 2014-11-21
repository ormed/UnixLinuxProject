<?php 

@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include_once ('parts/top.php');
include_once('../parts/help_functions.php');

//$result = shell_exec('cut -d : -f 1 /etc/passwd');
$result = shell_exec('cat /etc/passwd | grep "/home" |cut -d: -f1');
$result = split("\n", $result);
?>

	<div id="wrapper">

		<?php include_once ('parts/nav.php');?>
		<div id="page-wrapper">	
			<div class="container-fluid">
				
				<div class="col-sm-12">
					<div id="error" class="alert alert-danger col-sm-4 hide">
        				<a href="#" class="close" data-dismiss="alert">&times;</a>
        				<strong>Error!</strong><span></span>
    				</div>
    			</div>
				
				<form id="admin-form" class="form-horizontal" role="form">
						<input id="page" type="hidden" name="page" value="remove_user">
						<div class="form-group">
							<label for="inputCommand" class="col-sm-1 control-label">Users: </label>
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
						</div>
						<div class="col-sm-offset-1 col-sm-3">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>			
				</form>	
			</div>
		</div>
		
		<script src="js/admin_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>