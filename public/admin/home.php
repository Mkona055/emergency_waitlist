<?php
require_once('../_config.php');

session_start();
if (!isset($_SESSION['admin'])) {
    session_abort();
    header('Location: ./');

} else {
    $success = isset($_GET['success'])? $_GET['success'] : false;      
    $error = isset($_GET['error'])? $_GET['error'] : false;      
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
        <nav class="navbar navbar-expand-lg navbar-light border border-black bg-light ps-2">
            <a class="navbar-brand text-lg" href="./">
                Hospital triage
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="d-flex ms-auto collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./">Home</a>
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

        <h2 class="text-center mt-5 mb-5">Serve patients</h2>
        <div class="container rounded mt-5">

            <?php if ($success) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Patient was removed from the queue. <strong>Next patient can be served</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if ($error) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    An error occured while removing patient from the queue
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
                
            <table  class="me-5 table table-striped border border-black rounded">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Injury Severity</th>
                        <th scope="col">Came At</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Served</th>

                    </tr>
                </thead>
                <tbody id="patientsUnserved">                        
                </tbody>

            </table>

        </div>

    </body>

    </html>
    <?php
}
?>