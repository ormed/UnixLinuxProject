<?php 
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include_once('parts/top.php'); 
include_once('../parts/help_functions.php');

$performing_user = $_SESSION['user'];

$users = shell_exec('cut -d : -f 1 /etc/passwd');
$groups = shell_exec('cut -d : -f 1 /etc/group');
$users = split("\n", $users);
$groups = split("\n", $groups);
sort($users);
sort($groups);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['path'])) {
		$path = $_GET['path'];
		
		$file_type = shell_exec('sudo su -c "stat -c=\"%F\" ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
	
		// Check if user have permissions to edit this file
		if (!preg_match("/Permission denied/", $file_type)) {
			
			$file_type = str_replace('=', '', $file_type);
			$file_type = str_replace("\n", '', $file_type);
			$file_type = preg_replace("/(\sempty)+/", "", $file_type);
			
			$file_group = shell_exec('sudo su -c "stat -c=\"%G\" ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			$file_group = str_replace('=', '', $file_group);
			$file_group = str_replace("\n", '', $file_group);
			
			$file_owner = shell_exec('sudo su -c "stat -c=\"%U\" ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			$file_owner = str_replace('=', '', $file_owner);
			$file_owner = str_replace("\n", '', $file_owner);
			
			$permission = shell_exec('sudo su -c "stat -c=\"%a\" ' . $path . '" -s /bin/sh ' .  $performing_user . ' 2>&1');
			if (empty($permission)) {
				$permission = str_replace('=', '', $permission);
				$permission = str_replace("\n", '', $permission);
			
				$first = intval($permission[0]);
				$second = intval($permission[1]);
				$third = intval($permission[2]);
			}
		}
	}
}
?>

		<div id="wrapper">

			<?php include_once ('parts/nav.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">
					
					
					<form class="form-horizontal" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> role="form" method="get">
						<div class="form-group">
							<label for="inputPath" class="col-sm-1 control-label">Path: </label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="path" placeholder="Path" value="<?php echo(isset($path) ? $path : ''); ?>">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>	
					
					<?php if (preg_match("/Permission denied/", $file_type)) { ?>
					
					<pre>Permission denied</pre>
					
					
					<?php } elseif (strcmp($file_type, 'regular file') == 0) { 
						$checked = FALSE;
						//check if execute 
						if ($first == 5 || $first == 7) {
							$checked = TRUE;
							$first--;
							$second--;
							$third--;
						}
						
					?>
					
					<form id="admin-form" class="form-horizontal" role="form">
					
					<input id="page" type="hidden" name="page" value="ch_permission">
					<input id="path" type="hidden" name="path" value="<?php echo(isset($path) ? $path : ''); ?>">
					
					<legend>Permissions</legend>
						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
								<div class="col-sm-3">
								<select name="owner" class="form-ontrol">
									<?php foreach($users as $user) { 
										if ($user == '') {
											continue;
										}
									?>
										<option value="<?php echo($user); ?>" <?php echo($user == $file_owner) ? 'selected="selected"' : '' ?>><?php echo($user); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Access: </label>
								<div class="col-sm-3">
								<select name="owner-access" class="form-ontrol">
									<option value="4" <?php echo(($first == 4) ? 'selected="selected"' : ''); ?>>Read-only</option>
									<option value="6" <?php echo(($first == 6) ? 'selected="selected"' : ''); ?>>Read and write</option>
								</select>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Group: </label>
								<div class="col-sm-3">
								<select name="group" class="form-ontrol">
									<?php foreach($groups as $group) { 
										if ($group == '') {
											continue;
										}
									?>
										<option value="<?php echo($group);?>" <?php echo($group == $file_group) ? 'selected="selected"' : '' ?>><?php echo($group); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Access: </label>
								<div class="col-sm-3">
								<select name="group-access" class="form-ontrol">
									<option value="0" <?php echo(($second == 0) ? 'selected="selected"' : ''); ?>>None</option>
									<option value="4" <?php echo(($second == 4) ? 'selected="selected"' : ''); ?>>Read-only</option>
									<option value="6" <?php echo(($second == 6) ? 'selected="selected"' : ''); ?>>Read and write</option>
								</select>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Others: </label>
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Access: </label>
								<div class="col-sm-3">
								<select name="others-access" class="form-ontrol">
									<option value="0" <?php echo(($third == 0) ? 'selected="selected"' : ''); ?>>None</option>
									<option value="4" <?php echo(($third == 4) ? 'selected="selected"' : ''); ?>>Read-only</option>
									<option value="6" <?php echo(($third == 6) ? 'selected="selected"' : ''); ?>>Read and write</option>
								</select>
								</div>	
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputPath" class="col-sm-1 control-label">Execute: </label>
							<span>
								<label class="col-sm-3"><input type="checkbox" name="allow-execute" <?php echo(($checked) ? 'checked="checked"' : ''); ?>> Allow executing files as program</label>
							</span>
						</div>
						
						<button type="submit" class="btn btn-primary">Update Permissions</button>
						
					</form>	
					
					<?php } elseif ($file_type == 'directory') { ?>
					
					<!--directory form -->
					<form id="admin-form" class="form-horizontal" role="form">
					
					<input id="page" type="hidden" name="page" value="ch_permission">
					<input id="path" type="hidden" name="path" value="<?php echo(isset($path) ? $path : ''); ?>">
					
					<legend>Permissions</legend>
						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
								<div class="col-sm-3">
								<select name="owner" class="form-ontrol">
									<?php foreach($users as $user) { 
										if ($user == '') {
											continue;
										}
									?>
										<option value="<?php echo($user); ?>" <?php echo($user == $file_owner) ? 'selected="selected"' : '' ?>><?php echo($user); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Folder Access: </label>
								<div class="col-sm-3">
								<select name="owner-access" class="form-ontrol">
									<option value="4" <?php echo(($first == 4) ? 'selected="selected"' : ''); ?>>List files only</option>
									<option value="5" <?php echo(($first == 5) ? 'selected="selected"' : ''); ?>>Access files</option>
									<option value="7" <?php echo(($first == 7) ? 'selected="selected"' : ''); ?>>Create and delete files</option>
								</select>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Groups: </label>
								<div class="col-sm-3">
								<select name="group" class="form-ontrol">
									<?php foreach($groups as $group) { 
										if ($group == '') {
											continue;
										}
									?>
										<option value="<?php echo($group); ?>" <?php echo($group == $file_group) ? 'selected="selected"' : '' ?>><?php echo($group); ?></option>
									<?php } ?>
								</select>
								</div>
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Folder Access: </label>
								<div class="col-sm-3">
								<select name="group-access" class="form-ontrol">
									<option value="0" <?php echo(($second == 0) ? 'selected="selected"' : ''); ?>>None</option>
									<option value="4" <?php echo(($second == 4) ? 'selected="selected"' : ''); ?>>List files only</option>
									<option value="5" <?php echo(($second == 5) ? 'selected="selected"' : ''); ?>>Access files</option>
									<option value="7" <?php echo(($second == 7) ? 'selected="selected"' : ''); ?>>Create and delete files</option>
								</select>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Others: </label>
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Folder Access: </label>
								<div class="col-sm-3">
								<select name="others-access" class="form-ontrol">
									<option value="0" <?php echo(($third == 0) ? 'selected="selected"' : ''); ?>>None</option>
									<option value="4" <?php echo(($third == 4) ? 'selected="selected"' : ''); ?>>List files only</option>
									<option value="5" <?php echo(($third == 5) ? 'selected="selected"' : ''); ?>>Access files</option>
									<option value="7" <?php echo(($third == 7) ? 'selected="selected"' : ''); ?>>Create and delete files</option>
								</select>
								</div>	
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Update Permissions</button>
						
					</form>
					
					<?php } ?>
					
				</div>
			</div>	
			
	<script src="js/admin_commands.js"></script>
	
<?php include_once('parts/bottom.php'); ?>	

					