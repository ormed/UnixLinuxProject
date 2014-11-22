<?php 
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include_once('parts/top.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['option'])) {
		$option = $_POST['option'];
	}
}
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
    			
    			<form class="form-horizontal" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> role="form" method="post">
    			<input id="page" type="hidden" name="page" value="backup_restore">
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">Backup/Resrore: </label>
						<div class="col-sm-3">
							<select name="option" class="form-ontrol">
								<option value="backup">Backup</option>
								<option value="restore">Restore</option>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Select</button>
					</div>
				</form>
				
				<?php if (($_SERVER['REQUEST_METHOD'] === 'POST') && ($option == 'backup')) {?>
				
				<form id="admin-form" class="form-horizontal" role="form">
				
				<input type="hidden" name="page" value="backup">
				
				<legend>Backup</legend>	
					<div class="form-group">
						<label foid="page"r="inputCommand" class="col-sm-1 control-label">Backup from: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="path" placeholder="Enter directory path">
						</div>
					</div>	
					
					<div class="form-group">
						<label foid="page"r="inputCommand" class="col-sm-1 control-label">Files: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="files-to-backup" placeholder="Files to backup">
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">Backup to: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="backup-to" placeholder="Backup to">
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">File name: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="file-name" placeholder="File name">
						</div>
					</div>
											
					<div class="col-sm-offset-1 col-sm-3">
						<button type="submit" class="btn btn-primary">Backup</button>
					</div>
				</form>
				
				<?php } 
				elseif(($_SERVER['REQUEST_METHOD'] === 'POST') && ($option == 'restore')) {?>
				
				<form id="admin-form" class="form-horizontal" role="form">
				
				<input type="hidden" name="page" value="restore">
				
				<legend>Restore</legend>		
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">file to restore: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="files-to-restore" placeholder="files to restore">
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputCommand" class="col-sm-1 control-label">Restore to: </label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="restore-to" placeholder="Restore to">
						</div>
					</div>	
											
					<div class="col-sm-offset-1 col-sm-3">
						<button type="submit" class="btn btn-primary">Restore</button>
					</div>
				</form>	
				
				<?php } ?>
				
			</div>
		</div>
		
		<script src="js/admin_commands.js"></script>
			
<?php include_once('parts/bottom.php'); ?>
				
    			
