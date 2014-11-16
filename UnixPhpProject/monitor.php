<?php include_once('parts/top.php');
include_once('parts/help_functions.php');

$disk_usage = shell_exec('df');

//build array from df
$disks = array();
foreach(explode("\n", $disk_usage) as $line) {
	$partition = array();
	$found = preg_match_all("/([^\s].+?)\s/", $line, $partition);
	if ($found) {
		$disks[] = $partition[1];
	}
}

$processes = shell_exec('top -n 1 -b');
$mem_free = shell_exec('free -m');



?>

		<div id="wrapper">

			<?php
			include_once ('parts/nav.php');
			?>

			<div id="page-wrapper">

				<div class="container-fluid ">
					
					<div id="chart_div" style="width: 900px; height: 500px;"></div>

					<pre><?php var_dump($disks); ?></pre>
					
					<pre><?php echo($processes); ?></pre>
					
					<pre><?php echo($mem_free); ?></pre>
					
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

	<script type="text/javascript" src="js/monitor.js"></script>

<?php include_once('parts/bottom.php'); ?>