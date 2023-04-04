<?php
require_once('../_config.php');
use Models\Patient;

if (isset($_POST) && !empty($_POST)) {
    $form = $_POST;
    $patient = Patient::getPatientfromForm($form);
    if ($patient->save($dbconn)) {
        $saved = true;
        header("Location: ./addpatient.php?success=true&code=" . $patient->code);

    } else {
        $error = true;
        header("Location: ./addpatient.php?error=true");

    };
}

?>