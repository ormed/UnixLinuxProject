<?php include_once('parts/top.php'); 
include_once('../parts/help_functions.php');

$users = shell_exec('cut -d : -f 1 /etc/passwd');
$group = shell_exec('cut -d : -f 1 /etc/group');
$users = split("\n", $users);
$group = split("\n", $group);
sort($users);
sort($group);
?>

		<div id="wrapper">

			<?php include_once ('parts/nav.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">
				<!--file form -->
					<!--<form class="form-horizontal" role="form">
					<input id="page" type="hidden" name="page" value="ch_permissions">
						<div class="form-group">
							<label for="inputPath" class="col-sm-1 control-label">Path: </label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="path" placeholder="Path">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>	
					
					<form class="form-horizontal" role="form">
					<legend>Permissions</legend>
						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<?php foreach($users as $value) { 
										if ($value == '') {
											continue;
										}
									?>
										<option value="<?php echo($value); ?>"><?php echo($value); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">Read-only</option>
									<option value="read_write">Read and write</option>
								</select>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<?php foreach($group as $value) { 
										if ($value == '') {
											continue;
										}
									?>
										<option value="<?php echo($value); ?>"><?php echo($value); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">Read-only</option>
									<option value="read_write">Read and write</option>
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
								<select name="option" class="form-ontrol">
									<option value="read_only">Read-only</option>
									<option value="read_write">Read and write</option>
								</select>
								</div>	
							</div>
						</div>
				$result		
					</form>	-->
					
					<!--directory form -->
					<form class="form-horizontal" role="form">
					<input id="page" type="hidden" name="page" value="ch_permissions">
						<div class="form-group">
							<label for="inputPath" class="col-sm-1 control-label">Path: </label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="path" placeholder="Path">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>	
					
					<form class="form-horizontal" role="form">
					<legend>Permissions</legend>
						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<?php foreach($users as $value) { 
										if ($value == '') {
											continue;
										}
									?>
										<option value="<?php echo($value); ?>"><?php echo($value); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Folder Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">List file only</option>
									<option value="read_write">Access file</option>
									<option value="read_write">Create and delete file</option>
									<option value="read_write">---</option>
								</select>
								</div>	
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">File Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">Read-only</option>
									<option value="read_write">Read and write</option>
									<option value="read_write">---</option>
								</select>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Groups: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<?php foreach($group as $value) { 
										if ($value == '') {
											continue;
										}
									?>
										<option value="<?php echo($value); ?>"><?php echo($value); ?></option>
									<?php } ?>
								</select>
								</div>
		
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Folder Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">None</option>
									<option value="read_only">List file only</option>
									<option value="read_write">Access file</option>
									<option value="read_write">Create and delete file</option>
									<option value="read_write">---</option>
								</select>
								</div>	
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">File Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">Read-only</option>
									<option value="read_write">Read and write</option>
									<option value="read_write">---</option>
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
								<select name="option" class="form-ontrol">
									<option value="read_only">None</option>
									<option value="read_only">List file only</option>
									<option value="read_write">Access file</option>
									<option value="read_write">Create and delete file</option>
									<option value="read_write">---</option>
								</select>
								</div>	
							</div>
							
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">File Access: </label>
								<div class="col-sm-3">
								<select name="option" class="form-ontrol">
									<option value="read_only">Read-only</option>
									<option value="read_write">Read and write</option>
									<option value="read_write">---</option>
								</select>
								</div>	
							</div>
						</div>
						
					</form>
					
				</div>
			</div>	
			
			<script src="js/perl_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>	
					