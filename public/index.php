<?php

$error_message = null;
if (isset($_SESSION['patient']) && $_SESSION['patient'] !== null) {
    header("Location: app/home.php");
    exit();
}
if (isset($_POST["last_name"]) && isset($_POST["code"]) ){
    $last_name = $_POST["last_name"];
    $code = $_POST["code"];
    $result = validateLogin($last_name, $code);
    if($result){        
        session_start();
        $_SESSION['patient'] = $result; 
        header("Location: app/home.php");
        exit();
    }else{
        $error_message = "Invalid login";
    };
}
function validateLogin($last_name, $code){
    $clientData = null;
    $dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=postgres");
    $result = pg_query($dbconn, "SELECT * FROM patients WHERE last_name = '$last_name' AND code = '$code'");    
    if (!$result || pg_num_rows($result) == 0) {
        echo "Not found";    
    }else{
        $clientData = $result;
    }        
    pg_close($dbconn);
    return $clientData;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- Custom CSS -->
	<style type="text/css">
		body {
			background-color: #f2f2f2;
		}

		.login-form {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
		}
	</style>
</head>
<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="login-form">
					<h3 class="text-center mb-4">Hospital Triage</h3>
					<form method=post action=index.php>
						<div class="form-group">
							<label for="last_name">Last Name:</label>
							<input type="text" class="form-control" id="last_name" name="last_name" value=<?php echo $_POST["last_name"] ?> required>
						</div>
						<div class="form-group">
							<label for="password">Code(3 letters):</label>
							<input type="password" class="form-control" id="code" name="code" value=<?php echo $_POST["code"] ?>  required>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
