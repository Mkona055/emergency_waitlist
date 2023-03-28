<?php
require_once('../_config.php');

$error_message = null;        
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] !== null) {
    header("Location: ./home.php");
    exit();
}
if (isset($_POST["username"]) && isset($_POST["password"]) ){
    header("Location: ./home.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = validateAdminLogin($username, $password);
    if($result){        
        $_SESSION['admin'] = $result; 
        //header("Location: ./admin/home.php");
        exit();
    }else{
        $error_message = "Invalid login";
    };
}
function validateAdminLogin($username, $password){
    $adminData = null;
    $dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=postgres");
    $result = pg_query($dbconn, "SELECT * FROM admins WHERE username = '$username' AND password = '$password'");    
    if (!$result || pg_num_rows($result) == 0) {
        echo "Not found";    
    }else{
        $adminData = pg_fetch_assoc($result);
    }        
    pg_close($dbconn);
    return $adminData;
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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script></head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="login-form">
					<h3 class="text-center mb-4">Hospital Triage </h3>
					<form class="needs-validation" method=post action="./">
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
