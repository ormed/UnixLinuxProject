<?php
@session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

include_once ('parts/top.php');
?>

<div id="wrapper">

	<?php
	include_once ('parts/nav.php');
	?>

	<div id="page-wrapper">
		<div class="container-fluid">
		
			<input type="hidden" id="prev-folder" name="prev-folder" value="/">
			<input type="hidden" id="folder-option" name="folder-option" value="-al">
			<input type="hidden" id="copied-entity" name="copied-entity" value="">
			
			<ul class="custom-menu" id="file-menu">
				<li data-action="view">View</li>
				<li data-action="edit">Edit</li>
				<li data-action="copy">Copy</li>
				<li data-action="move">Cut</li>
				<li data-action="delete">Delete</li>
				<li data-action="change_permissions">Change Permissions</li>
				<li data-action="properties">Properties</li>
			</ul>
			
			<ul class="custom-menu" id='folder-menu'>
				<li data-action="open">Open</li>
				<li data-action="copy">Copy</li>
				<li data-action="move">Cut</li>
				<li data-action="delete">Delete</li>
				<li data-action="change_permissions">Change Permissions</li>
				<li data-action="properties">Properties</li>
			</ul>
			
			<ul class="custom-menu" id='special-file-menu'>
				<li data-action="properties">Properties</li>
			</ul>

			<div class="row">
				<label class="col-sm-3"><input type="checkbox" id="show-hidden-files" checked="checked"> Include Hidden Files</label>
        		
        		<span class="col-sm-6">
        		<label>Current Folder: </label>
        		<label for="folderPath" id="current-folder" name="current-folder">/</label>
        		</span>
        		
			</div>
			
			<div class="row">
				<span class="col-sm-6">
        		<label class="col-sm-4">Search this folder: </label>
        		<input id="search-folder" class="col-sm-8" type="text" placeholder="Enter file name..">
        		</span>
        		
        		<div class="col-sm-2">
					<select id="search-option" class="form-control">
						<option value="-name">By name</option>
					</select>
				</div>
        		
        		<button id="search-btn" type="button" class="btn btn-primary btn-sm col-sm-1">Search</button>
        		
        		<span id="search-result" class="col-sm-6">
        			<label class="col-sm-2">Result: </label>
        			<div class="col-sm-7">
						<select id="result-path" class="form-control">
							<option value="other" selected="selected"></option>
						</select>
					</div>
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