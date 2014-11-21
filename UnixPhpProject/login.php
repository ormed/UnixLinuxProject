<?php
@session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
}

require_once ("parts/top.php");

if (($_SERVER["REQUEST_METHOD"] == "POST")) {
//insert user to session
$user = cleanInput($_POST['username']);
$_SESSION['user'] = $user;

header('Location: index.php');

} else {
?>

<div id="wrapper">

	<div id="page-wrapper">

		<div class="container-fluid">
		
			<form class="form-horizontal col-lg-3" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> role="form" method="post">
				<div class="form-group">
					<label for="inputUser">User Name</label>
					<input type="text" class="form-control" name="username" id="username" placeholder="Enter User name">
				</div>
				<div class="form-group">
					<label for="InputPass">Password</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-primary">Submit </button>
			</form>

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php
}
require_once ("parts/bottom.php");
?>
