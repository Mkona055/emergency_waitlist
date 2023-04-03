<?php
    require_once('./_config.php');

    session_start();
    if(!isset($_SESSION['patient'])){
        header('Location: ./');


    }else{
        
        ?>
            <html>
            <head>
                <title>Home</title>
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                <link rel="stylesheet" href="../styles/index.css">

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
                <script src="./scripts/patient.js"></script>

            </head>
            <body>
                <nav class="d-flex navbar navbar-expand-lg navbar-light border border-black bg-light ps-2">
                    <a class="navbar-brand text-lg" href="#">
                        Hospital Triage
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="d-flex flex-row-reverse ms-auto collapse navbar-collapse" id="navbarNav">
                    
                        <ul class="navbar-nav pe-5">
                            <li class="nav-item">
                                <a class="btn btn-danger" href="./logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-center" id="welcome-text"></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center" id="position-text"></h2>
                        </div>
                    </div>
                    <div class="mt-5 row">
                        <div class="col-12">
                            <h1 class="text-center estimated-time"></h1>
                            <h3 class="text-center" id="estimated-time"></h3>
                        </div>
                    </div>
            </body>
        </html>
    <?php
    }
    ?>