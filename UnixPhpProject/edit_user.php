<?php 
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include_once('parts/top.php'); 

$users = shell_exec('cat /etc/passwd | grep "/home" |cut -d: -f1');
//$groups = shell_exec('cat /etc/passwd | grep "/home" |cut -d: -f 5 | grep dvir');
//$groups = shell_exec('cut -d : -f 1 /etc/group');
$users = split("\n", $users);
//$groups = split("\n", $groups);
sort($users);
//sort($groups);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['user'])) {
		$selected_user = $_POST['user'];
		$full_user_path = shell_exec('cat /etc/passwd | grep "^' . $selected_user . ':"');
		$full_user = explode(':', $full_user_path);
	}
}
?>

	<div id="wrapper">

		<?php include_once ('parts/nav.php');?>
		<div id="page-wrapper">	
			<div class="container-fluid">
			
				<form class="form-horizontal" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> role="form" method="post">
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">Users: </label>
						<div class="col-sm-3">
							<select name="user" class="form-ontrol">
								<?php foreach($users as $value) { 
									if ($value == '') {
										continue;
									}
								?>
								<option value="<?php echo($value); ?>" <?php echo((isset($selected_user) && ($value == $selected_user)) ? 'selected="selected"' : ''); ?>><?php echo($value); ?></option>
								<?php } ?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Select</button>
					</div>			
				</form>


				<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
				<form id="admin-form" class="form-horizontal" role="form">
				
				<input id="page" type="hidden" name="page" value="edit_user">
				<input id="user" type="hidden" name="old-user" value="<?php echo(isset($selected_user) ? $selected_user : ''); ?>">
				
				<legend>Edit user</legend>		
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">User Name: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="new-user-name" placeholder="User Name" value="<?php echo(isset($selected_user) ? $selected_user : ''); ?>">
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">Full Name: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="full-name" placeholder="Full Name" value="<?php echo(isset($full_user) ? $full_user[4] : ''); ?>">
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
							<input type="text" class="form-control" name="home-dir" value="<?php echo(isset($full_user) ? $full_user[5] : '') ?>">
						</div>
					</div>
											
					<div class="col-sm-offset-1 col-sm-3">
						<button type="submit" class="btn btn-primary">Update user</button>
					</div>
				</form>
				<?php } ?>				
			</div>
		</div>
		
	
		<script src="js/admin_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>