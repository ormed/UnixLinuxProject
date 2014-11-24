<?php 
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /UnixLinuxProject/UnixPhpProject/login.php");
}

include_once('../parts/top.php');

?>

		<div id="wrapper">

			<?php
			include_once ('../parts/nav.php');
			?>

			<div id="page-wrapper">

				<div class="container-fluid">
				
				<div class="col-sm-12">
					<div id="error" class="alert alert-danger col-sm-4 hide">
        				<a href="#" class="close" data-dismiss="alert">&times;</a>
        				<strong>Error!</strong><span></span>
    				</div>
    			</div>
    				
				<div id="time">
					<label>Current Time: </label>
					<label id="current-time"></label>
				</div>
				
				<form class="form-horizontal" role="form">
				
				<input id="page" type="hidden" name="page" value="date">
				
				<div class="form-group">
					<label for="inputDate" class="col-sm-1 control-label">Date: </label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="datepicker" name="date" placeholder="Date">
					</div>
				</div>
				
				<div class="form-group">
					<label for="inputDate" class="col-sm-1 control-label">Time: </label>
					<div class="col-sm-3">
						<input class="col-sm-4" type="number" max="23" min="0" class="form-control" name="hour">
						<input class="col-sm-4" type="number" max="59" min="0" class="form-control" name="minute">
						<input class="col-sm-4" type="number" max="59" min="0" class="form-control" name="second">
					</div>
				</div>
							
				
				<button type="submit" class="btn btn-primary">Set System Time</button>
				
				</form>
				
				
				
				
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->


		<script src="../js/system_date.js"></script>
		
<?php include_once('../parts/bottom.php'); ?>