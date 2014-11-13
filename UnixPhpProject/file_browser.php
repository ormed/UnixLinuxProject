<?php
include_once ('parts/top.php');
?>

<div id="wrapper">

	<?php
	include_once ('parts/nav.php');
	?>

	<div id="page-wrapper">
		<div class="container-fluid">

			<ul class="custom-menu" id="file-menu">
				<li data-action="view">View</li>
				<li data-action="edit">Edit</li>
				<li data-action="copy">Copy</li>
				<li data-action="move">Cut</li>
				<li data-action="delete">Delete</li>
				<li data-action="properties">Properties</li>
			</ul>
			
			<ul class="custom-menu" id='folder-menu'>
				<li data-action="open">Open</li>
				<li data-action="copy">Copy</li>
				<li data-action="move">Cut</li>
				<li data-action="delete">Delete</li>
				<li data-action="properties">Properties</li>
			</ul>
			
			<ul class="custom-menu" id='special-file-menu'>
				<li data-action="properties">Properties</li>
			</ul>
			

			<input type="hidden" id="prev-folder" name="prev-folder" value="/">
			<input type="hidden" id="folder-option" name="folder-option" value="-al">
			<input type="hidden" id="copied-entity" name="copied-entity" value="">


			<div class="row">
				<label class="col-sm-3"><input type="checkbox" id="show-hidden-files" checked="checked"> Include Hidden Files</label>
        		
        		<span class="col-sm-3">
        		<label>Current Folder: </label>
        		<label for="folderPath" id="current-folder" name="current-folder">/</label>
        		</span>
        		
        		<span class="col-sm-4">
        		<label>Find: </label>
        		<input type="text" placeholder="Enter file name..">
        		<button type="button" class="btn btn-primary btn-sm">Search</button>
        		</span>
        		
			</div>
			
			<div id="file-browser" class="col-md-10">
			</div>
			
		</div>
		<!-- /#container-fuiid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<script src="js/file_manager.js"></script>
<script>
	var path = $('#current-folder').text();
	showFolders(path);
</script>

<?php
	include_once ('parts/bottom.php');
?>