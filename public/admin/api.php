<?php

require_once('../_config.php');
use Models\Patient;

session_start();
$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=postgres");


switch ($_GET["action"]) {
case "/getUnservedPatients":
    $patients = Patient::getOrderedPatientsfromDb($dbconn);
    $data = json_encode(["patients" => $patients]);
    break;
case "/markServed":
    $id = isset($_GET["id"])? $_GET["id"] : null;
    if ($id && Patient::markPatientServed($dbconn, $id)) {
        $data = json_encode(["success" => "Patient marked as served"]);

    } else {
        $data = json_encode(["error" => "Failed to mark patient as served"]);
    };
    break;
default:
    $data = json_encode(["error" => "404"]);
}

header("Content-Type: application/json");
echo $data;

?>