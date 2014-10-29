<?php include_once('parts/top.php'); ?>

		<div id="wrapper">

			<?php include_once ('parts/nav.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">
					<form class="form-horizontal" role="form">
							<input id="page" type="hidden" name="page" value="more">
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">more </label>
								<div class="col-sm-3">
									<select name="option" class="form-control">
										<option value="other">no option</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputPath" class="col-sm-1 control-label">File Path: </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="path" placeholder="Path">
								</div>
							</div>
							
							<div class="col-sm-offset-1 col-sm-3">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
					</form>
					
					<div id="respond" class="result-div"></div>
					
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->
		
		<script src="js/perl_commands.js"></script>
		
<?php include_once('parts/bottom.php'); ?>