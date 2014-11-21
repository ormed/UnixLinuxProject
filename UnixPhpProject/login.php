<?php
@session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
}

require_once ("parts/top.php");

$error = '';

if (($_SERVER["REQUEST_METHOD"] == "POST")) {
	//insert user to session
	$user = cleanInput($_POST['username']);
	$pass = cleanInput($_POST['password']);

	if (empty($user) || empty($pass)) {
		$error = 'Please fill all the form';
	} else {
	
		$result = shell_exec('sudo perl /var/www/html/UnixLinuxProject/UnixPerlProject/pass_verify.pl ' . $user . ' ' . $pass);

		if ($result) {
			$_SESSION['user'] = $user;
			header('Location: index.php');
		} else {
			$error = 'The user or password you entered is incorrect.';
		}
	}
} 
?>

<div id="wrapper">

	<div id="page-wrapper">

		<div class="container-fluid">
			
			<div class="col-lg-10">
				<div class="alert alert-danger col-lg-4">
        			<a href="#" class="close" data-dismiss="alert">&times;</a>
        			<strong>Error!</strong> <?php echo($error); ?>
    			</div>
			</div>

			<div class="col-lg-10">
				<form class="form-horizontal col-lg-4" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> role="form" method="post">
					<div class="form-group">
						<label for="inputUser">User Name</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Enter User name" value="<?php echo(isset($user) ? $user : ''); ?>">
					</div>
					<div class="form-group">
						<label for="InputPass">Password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary">Submit </button>
				</form>
			</div>
		
		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php require_once ("parts/bottom.php"); ?>
