<?php include_once ('parts/top.php');?>

<div id="wrapper">

	<?php include_once ('parts/nav.php');?>

	<div id="page-wrapper">
		<div class="container-fluid">
			<form id="admin-forrm" role="form">
				<div class="form-group">
					<label for="User Name">Enter user name</label>
					<input type="text" class="form-control" id="user-name" placeholder="User Name" name="user-name">
				</div>
				<div class="form-group">
					<label for="Password">Enter password</label>
					<input type="password" class="form-control" id="password" placeholder="Password" name="password">
				</div>
				<div class="form-group">
					<label for="Password">Enter password again</label>
					<input type="password" class="form-control" id="re-password" placeholder="Password" name="re-password">
				</div>
				<button type="submit" class="btn btn-default">
					Submit
				</button>
			</form>
			
			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->
		
<?php include_once('parts/bottom.php'); ?>