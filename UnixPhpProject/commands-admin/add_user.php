<?php 
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /UnixLinuxProject/UnixPhpProject/login.php");
}

include_once ('../parts/top.php');
include_once('../parts/help_functions.php');

$groups = shell_exec('cut -d: -f1 /etc/group');
$groups = split("\n", $groups);

?>

		<div id="wrapper">

			<?php include_once ('../parts/nav.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">
					<div class="col-sm-12">
						<div id="error" class="alert alert-danger col-sm-4 hide">
        					<a href="#" class="close" data-dismiss="alert">&times;</a>
        					<strong>Error!&nbsp;</strong> <span></span>
    					</div>
    				</div>
					<form id="admin-form" class="form-horizontal" role="form">
							<input id="page" type="hidden" name="page" value="add_user">
							
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">User Name: </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="user-name" placeholder="User Name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">Full Name: </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="full-name" placeholder="Full Name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">Password: </label>
								<div class="col-sm-3">
									<input type="password" class="form-control" name="pwd" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">Confirm Password: </label>
								<div class="col-sm-3">
									<input type="password" class="form-control" name="repwd" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">Home Directory: </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="home-dir">
								</div>
							</div>
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">Groups </label>
								<div class="col-sm-3">
									<select name="groups[]" class="form-control" multiple="multiple">
									<?php foreach($groups as $group) { 
									if ($group == '') {
										continue;
									}
								?>
									<option value="<?php echo($group); ?>"><?php echo($group); ?></option>
								<?php } ?>
									</select>
								</div>
							</div>							
							<div class="col-sm-offset-1 col-sm-3">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
					</form>
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->
		
		<script src="../js/admin_commands.js"></script>
		
<?php include_once('../parts/bottom.php'); ?>