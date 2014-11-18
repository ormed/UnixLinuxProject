<?php include_once('parts/top.php'); 
include_once('../parts/help_functions.php');

$users = shell_exec('cat /etc/passwd | grep "/home" |cut -d: -f1');
//$groups = shell_exec('cat /etc/passwd | grep "/home" |cut -d: -f 5 | grep dvir');
//$groups = shell_exec('cut -d : -f 1 /etc/group');
$users = split("\n", $users);
//$groups = split("\n", $groups);
sort($users);
//sort($groups);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['user'])) {
		$user = $_GET['user'];
		$full_name = shell_exec('cat /etc/passwd | grep "/home" |cut -d: -f 5 | grep ' . $user);
		echo($full_name);
	}
}
?>

	<div id="wrapper">

		<?php include_once ('parts/nav.php');?>
		<div id="page-wrapper">	
			<div class="container-fluid">
			
				<form id="admin-form" class="form-horizontal" role="form" method="get">
				<input id="page" type="hidden" name="page" value="edit_user">
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">Users: </label>
						<div class="col-sm-3">
							<select name="user" class="form-ontrol">
								<?php foreach($users as $value) { 
									if ($value == '') {
										continue;
									}
								?>
								<option value="<?php echo($value); ?>"><?php echo($value); ?></option>
								<?php } ?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>			
				</form>
				
				<form id="admin-form" class="form-horizontal" role="form">
				
				<input id="page" type="hidden" name="page" value="edit_user">
				<input id="user" type="hidden" name="user" value="<?php echo(isset($user) ? $user : ''); ?>">
				
				<legend>Edit user</legend>		
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
							<select name="groups" class="form-control">
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
						<button type="submit" class="btn btn-primary">Update user</button>
					</div>
				</form>
								
			</div>
		</div>
		
		<script src="js/admin_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>