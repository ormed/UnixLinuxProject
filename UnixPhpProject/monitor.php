<?php include_once('parts/top.php');
include_once('parts/help_functions.php');

$disk_usage = shell_exec('df -BM');

//build array from df
$disks = array();
foreach(explode("\n", $disk_usage) as $line) {
	$partition = array();
	$found = preg_match_all("/([^\s].+?)\s/", $line, $partition);
	if ($found) {
		$disks[] = $partition[1];
	}
}
array_shift($disks); //remove the headers at the start of array

$cpu = shell_exec('mpstat | grep "all"');

$mem_free = shell_exec('free -m');



?>

		<div id="wrapper">

			<?php
			include_once ('parts/nav.php');
			?>

			<div id="page-wrapper">

				<div class="container-fluid ">
					
					<div class="row">
						<div class="col-lg-7" id="chart_div" style="width: 500px; height: 200px;"></div>
						<div class="col-lg-6">
							<label>Monitor</label>
							<div class="col-lg-7" id="cpu_div" style="width: 500px; height: 200px;"></div>
						</div>
					</div>
					
					<label>Memory usage</label>
					<pre><?php echo($mem_free); ?></pre>
					
					<label>Processes table</label>
					<pre id="process-table"></pre>
					
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

	<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
	<script>var disks = <?php echo(json_encode($disks)); ?>;</script>
	<script type="text/javascript" src="js/monitor.js"></script>
		
<?php include_once('parts/bottom.php'); ?>