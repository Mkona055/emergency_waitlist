<?php
require_once('../_config.php');
$error = isset($_GET['error'])? $_GET['error'] : false;      
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] !== null) {
    header("Location: ./home.php");
    exit();
}else{
	session_abort();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Portal </title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/index.css">

    <!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="login-form">
					<h3 class="text-center mb-4">Hospital Triage </h3>
					<?php if ($error) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Invalid credentials
						</div>
                	<?php } ?>
					<form class="needs-validation" method=post action="./login.php">
						<div class="form-group">
							<label for="last_name">Admin Username :</label>
							<input required type="text" class="form-control" id="username" name="username" value=<?php if (isset($_POST["username"])){
																															echo $_POST["username"];
																														} else {
																															echo "";
																														}?> >
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input required type="password" class="form-control" id="password" name="password" value=<?php if (isset($_POST["password"])){
																															echo $_POST["password"];
																														} else {
																															echo "";
																														}?> >
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
</body>
</html>
