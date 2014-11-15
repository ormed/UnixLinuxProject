<?php include_once('parts/top.php');
include_once('parts/help_functions.php');

$disk_usage = shell_exec('df');
$processes = shell_exec('top -n 1 -b');
$mem_free = shell_exec('free -m');



?>

		<div id="wrapper">

			<?php
			include_once ('parts/nav.php');
			?>

			<div id="page-wrapper">

				<div class="container-fluid ">
					
					<pre><?php echo($disk_usage); ?></pre>
					
					<pre><?php echo($processes); ?></pre>
					
					<pre><?php echo($mem_free); ?></pre>
					
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

<?php include_once('parts/bottom.php'); ?>