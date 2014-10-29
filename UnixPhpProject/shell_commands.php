<?php include_once('parts/top.php'); ?>

		<div id="wrapper">

			<?php include_once ('parts/nav.php'); ?>

			<div id="page-wrapper">

				<div class="container-fluid">
					<form class="form-horizontal" role="form" style="margin-bottom: 70px;">
							
							<div class="form-group">
								<label for="inputCommand" class="col-sm-1 control-label">Enter Command: </label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="command" placeholder="Command">
								</div>
							</div>
							
							<div class="col-sm-offset-1 col-sm-3">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
					</form>
					
					<pre id="command-respond"></pre>
					
				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- /#page-wrapper -->

		</div>
		<!-- /#wrapper -->
		
		<script src="js/shell_commands.js"></script>
		
<?php include_once('parts/bottom.php'); ?>