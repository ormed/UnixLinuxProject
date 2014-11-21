<?php 
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include_once('parts/top.php');?>

		<div id="wrapper">

			<?php
			include_once ('parts/nav.php');
			?>

			<div id="page-wrapper">

				<div class="container-fluid">
					<h1>Welcome to Linux remote access system</h1>
					<img src="images/linux_peng.jpg" />
				
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

<?php include_once('parts/bottom.php'); ?>