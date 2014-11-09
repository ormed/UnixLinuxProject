<?php
include_once ('parts/top.php');
?>

<div id="wrapper">

	<?php
	include_once ('parts/nav.php');
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<ul class='custom-menu'>
				<li data-action="first">First thing</li>
				<li data-action="second">Second thing</li>
				<li data-action="third">Third thing</li>
			</ul>

			<input type="hidden" id="current-folder" name="current-folder" value="/home/">
			<input type="hidden" id="prev-folder" name="prev-folder" value="/">
			<input type="hidden" id="folder-option" name="folder-option" value="-al">

			<div id="file-browser" class="col-md-6">
				
					<div class="file col-md-1">
						<input type="image" src="images/fileicons/default.png" class="btn-file">
						<label class="text-center">Short text</label>
					</div>
			</div>

		</div>
		<!-- /#container-fuiid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="js/file_manager.js"></script>
<script>
	var path = $('#current-folder').val();
	showFolders(path);
</script>

<?php
	include_once ('parts/bottom.php');
?>