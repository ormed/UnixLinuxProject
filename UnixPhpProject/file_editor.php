<?php

include_once ('parts/top.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['option']) && isset($_GET['path'])) {
		$option = $_GET['option'];
		$path = $_GET['path'];
		$json_text = json_decode(shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/more.pl "" ' . $path));
		$text = "";

		foreach ($json_text as $line) {
			$text .= $line . "\n";
		}
	}
}
?>

<div id="wrapper">

	<?php
	include_once ('parts/nav.php');
	?>

	<div id="page-wrapper">
		<div class="container-fluid">
		
		<form class="form-horizontal" role="form" method="get">
				<div class="form-group">
					<label for="inputCommand" class="col-sm-1 control-label">Open File As </label>
					<div class="col-sm-3">
						<select name="option" class="form-control">
							<option value="view">View Only</option>
							<option value="edit">Edit</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputPath" class="col-sm-1 control-label">File Path: </label>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="path" placeholder="Path" value="<?php echo(isset($path) ? $path : ''); ?>">
					</div>
				</div>

				<div class="col-sm-offset-1 col-sm-3">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		
			<span class="col-sm-offset-4 col-sm-4">
        		<label>Find: </label>
        		<input type="text"placeholder="Enter your search..">
        		<button type="button" class="btn btn-primary btn-sm">Search</button>
        	</span>
		
		<?php if (isset($option) && $option == 'view') { ?>
		
			<div id="respond" class="result-div">
				<pre><?php echo(htmlEntities($text)); ?></pre>
			</div>
					
		<?php } elseif (isset($option) && $option == 'edit') { 
					$lines_arr = preg_split('/\n|\r/',$text);
					$num_newlines = count($lines_arr); 
		?>
			<div id="respond" class="result-div">
			<form id="save-edit" role="form">
				<input type="hidden" id="current-file" name="current-file"; value="<?php echo(isset($path) ? $path : ''); ?>">
				<textarea class="form-control" id="text-editor" name="text-editor" rows="<?php echo($num_newlines); ?>"><?php echo(htmlEntities($text)); ?></textarea>
				<button type="submit" class="btn btn-primary">Save</button>
			</form>
			</div>
			
		<?php } ?>
			
		</div>
		<!-- /#container-fuiid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="js/file_editor.js"></script>

<?php
	include_once ('parts/bottom.php');
?>