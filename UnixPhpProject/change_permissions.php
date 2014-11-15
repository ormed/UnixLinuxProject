<?php include_once('parts/top.php'); 
include_once('../parts/help_functions.php');

$result = shell_exec('cut -d : -f 1 /etc/passwd');
$result = split("\n", $result);
sort($result);

?>

		<div id="wrapper">

			<?php include_once ('parts/nav.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">
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
						<input id="page" type="hidden" name="page" value="ch_permissions">
						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
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
						
						<form class="form-horizontal" role="form">
						<input id="page" type="hidden" name="page" value="ch_permissions">
						<div class="form-group">
							<div class="row">
								<label for="inputPath" class="col-sm-1 control-label">Owner: </label>
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
						
					</form>
					
					