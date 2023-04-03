<?php
require_once('_config.php');

session_start();
$error = isset($_GET['error'])? $_GET['error'] : false;      

if (isset($_SESSION['patient']) && $_SESSION['patient'] !== null) {
    header("Location: ./home.php");
    exit();
}else{
	session_abort();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="styles/index.css">
	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="login-form">
					<h3 class="text-center mb-4">Hospital Triage</h3>
					<?php if ($error) { ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Invalid credentials
						</div>
                	<?php } ?>
					<form class="needs-validation" method=post action="login.php">
						<div class="form-group">
							<label for="last_name">Last Name:</label>
							<input required type="text" class="form-control" id="last_name" name="last_name" value=<?php if (isset($_POST["last_name"])){
																															echo $_POST["last_name"];
																														} else {
																															echo "";
																														}?> >
						</div>
						<div class="form-group">
							<label for="password">Code(3 letters):</label>
							<input required type="password" class="form-control" id="code" name="code" value=<?php if (isset($_POST["code"])){
																															echo $_POST["code"];
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
