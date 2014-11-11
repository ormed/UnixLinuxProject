<?php

if (!isset($_GET['option']) || !isset($_GET['path'])) {
	header("Location: index.php");
}

include_once ('parts/top.php');

$option = $_GET['option'];
$path = $_GET['path'];

$json_text = json_decode(shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/more.pl "" ' . $path));
$text = "";

foreach ($json_text as $line) {
	$text .= $line . "\n";
}
?>

<div id="wrapper">

	<?php
	include_once ('parts/nav.php');
	?>

	<div id="page-wrapper">
		<div class="container-fluid">
		
		<?php if ($option == 'view') { ?>
		
			<pre><?php echo(htmlEntities($text)); ?></pre>
					
		<?php } elseif ($option == 'edit') { ?>
		
		
		<?php } ?>
			
		</div>
		<!-- /#container-fuiid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php
	include_once ('parts/bottom.php');
?>