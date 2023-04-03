<?php

if (isset($_POST["last_name"]) && isset($_POST["code"]) ){
    $last_name = $_POST["last_name"];
    $code = $_POST["code"];
    $result = validateLogin($last_name, $code);
    if($result){       
        session_start(); 
        $_SESSION['patient'] = $result; 
        header("Location: ./home.php");
        exit();
    }else{
        header("Location: index.php?error=true");
    };
}
function validateLogin($last_name, $code){
    $clientData = null;
    $dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=postgres");
    $result = pg_query($dbconn, "SELECT * FROM patients WHERE last_name = '$last_name' AND code = '$code' AND served = 'false'");    
    if ($result && pg_num_rows($result) !== 0) {
        $clientData = pg_fetch_assoc($result);  
    }           
    pg_close($dbconn);
    return $clientData;
}
?>