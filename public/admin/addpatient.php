<?php
require_once('../_config.php');
use Models\Patient;
session_start();
if (!isset($_SESSION['admin'])) {

} else { 
    $saved = false;
    $error = false;
    if (isset($_POST) && !empty($_POST)) {
        $dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=postgres");
        $form = $_POST;
        $patient = Patient::getPatientfromForm($form);
        if ($patient->save($dbconn)) {
            $saved = true;
        } else {
            $error = true;
        };
    }
    
    ?>

    <html>
        <head>
            <title>Admin Page</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
            <script src="../scripts/admin.js"></script>

        </head>

        <body>
            <nav class="d-flex navbar navbar-expand-lg navbar-light border border-black bg-light ps-2">
                <a class="navbar-brand text-lg" href="#">
                    Hospital triage
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="d-flex ms-auto collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./admin">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./addpatient.php">Add Patient</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto pe-5">
                        <li class="nav-item">
                            <a class="btn btn-danger" href="./logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container  mt-5">
            <h2 class="text-center mt-5 mb-5">Add patients</h2>
                <?php if ($saved) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Patient was saved successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <?php if ($error) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        An error occured while saving the patient information
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>


                <form id=form class="row g-3 needs-validation border rounded border-2  mt-2" method=post
                    action=./addpatient.php>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="first_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" name="last_name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Email</label>
                        <input type="email" class="form-control" id="validationCustom03" name="email" required>
                        <div class="invalid-feedback">
                            Please provide a valid email.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom04" class="form-label">Injury Severity</label>
                        <select class="form-control form-select" id="validationCustom04" name="injury_severity" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="4">Extreme Severity</option>
                            <option value="3">High Severity</option>
                            <option value="2">Medium Severity</option>
                            <option value="1">Low Severity</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid severity.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" inputmask='(999)-999-9999'
                            pattern="\([0-9]{3}\)-[0-9]{3}-[0-9]{4}" id="validationCustom05" name="phone_number" required>
                        <div class="invalid-feedback">
                            Please provide a valid phone number.
                        </div>
                    </div>
                    <div class="mt-4 mb-2 col-12">
                        <button class="btn btn-primary" type="submit">Add patient</button>
                    </div>
                </form>
            </div>
        </body>

        </html>
    <?php
}
?>
