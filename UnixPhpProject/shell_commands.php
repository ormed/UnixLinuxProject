<?php include_once('parts/top.php'); ?>

	<body>

		<div id="wrapper">

			<?php include_once ('parts/nav.php'); ?>

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
		
		<script src="js/ajax.js"></script>
		
<?php include_once('parts/bottom.php'); ?>