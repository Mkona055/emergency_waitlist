<?php
require_once('../_config.php');

if (isset($_POST["username"]) && isset($_POST["password"]) ){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $result = validateAdminLogin($username, $password, $dbconn);
    $test = $dbconn;
    if($result){        
        session_start();
        $_SESSION['admin'] = $result; 
		header("Location: ./home.php");
        exit();
    }else{
        header("Location: ./index.php?error=true");

    };
}
function validateAdminLogin($username, $password, $dbconn){
    $adminData = null;
    $result = pg_query($dbconn, "SELECT * FROM admins WHERE username = '$username' AND password = '$password'");    
    if ($result && pg_num_rows($result) !== 0) {
        $adminData = pg_fetch_assoc($result);  
    }      
    pg_close($dbconn);
    return $adminData;
}
?>