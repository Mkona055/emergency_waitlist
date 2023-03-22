<?php
    session_start();
    if(!isset($_SESSION['patient'])){
        header('Location: /');

    }else{?>
                <html>
            <head>
                <title>Home</title>
            </head>
            <body>
                <h1>Home</h1>
                <p>Logged In patient<?php print($_SESSION['patient']['served'] === 'f') ?> </p>
            </body>
        </html>
    <?php
    }
    ?>