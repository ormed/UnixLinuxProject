<?php include_once ('parts/top.php');?>

<div id="wrapper">

	<?php include_once ('parts/nav.php');?>

	<div id="page-wrapper">
		<div class="container-fluid">
			
			<ul class='custom-menu'>
  				<li data-action="first">First thing</li>
  				<li data-action="second">Second thing</li>
  				<li data-action="third">Third thing</li>
			</ul>
			
			<div class="folder">
				<input type="image" src="images/fileicons/_Documents.png" class="btn-folder" ondblclick="alert('double click')">
				<label class="text-center">Folder Name</label>
			</div>
			
			<div class="file">
				<input type="image" src="images/fileicons/default.png" class="btn-file" ondblclick="alert('double click')">
				<label class="text-center">a very fucking long file name</label>
			</div>
			
			<div class="file">
				<input type="image" src="images/fileicons/default.png" class="btn-file" ondblclick="alert('double click')">
				<label class="text-center">Short text</label>
			</div>
						
		</div>
		<!-- /#container-fuiid -->
		
	</div>
	<!-- /#page-wrapper -->
	
</div>
<!-- /#wrapper -->
<script src="js/file_manager.js"></script>

<?php include_once('parts/bottom.php'); ?>