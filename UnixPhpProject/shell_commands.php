<!DOCTYPE html>
<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>SB Admin - Bootstrap Admin Template</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="css/sb-admin.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>

		<div id="wrapper">

			<?php
			include_once ('parts/nav.php');
			?>

			<div id="page-wrapper">

				<div class="container-fluid">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<div class="col-lg-offset-1">
								<label class="radio-inline">
									<input type="radio" name="ls-option" id="inlineRadioA" value="-a">
									-a </label>
								<label class="radio-inline">
									<input type="radio" name="ls-option" id="inlineRadioL" value="-l">
									-l </label>
								<label class="radio-inline">
									<input type="radio" name="ls-option" id="inlineRadioAL" value="-al">
									-al </label>
							</div>
							<div class="col-lg-4">
								<input type="text" class="form-control" name="path" placeholder="Path">
							</div>
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>

					</form>
					
					<div id="ls_respond">
						
					</div>
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->

		<!-- jQuery Version 1.11.0 -->
		<script src="js/jquery-1.11.0.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<script src="js/ajax.js"></script>

	</body>

</html>
