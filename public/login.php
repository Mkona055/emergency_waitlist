<?php
require_once('_config.php');

if (isset($_POST["last_name"]) && isset($_POST["code"]) ){
    $last_name = $_POST["last_name"];
    $code = $_POST["code"];
    $result = validateLogin($last_name, $code, $dbconn);
    if($result){       
        session_start(); 
        $_SESSION['patient'] = $result; 
        header("Location: ./home.php");
        exit();
    }else{
        header("Location: index.php?error=true");
    };
}
function validateLogin($last_name, $code, $dbconn){
    $clientData = null;
    $result = pg_query($dbconn, "SELECT * FROM patients WHERE last_name = '$last_name' AND code = '$code'");    
    if ($result && pg_num_rows($result) !== 0) {
        $clientData = pg_fetch_assoc($result);  
    }           
    pg_close($dbconn);
    return $clientData;
}
?>