<?php
session_start();

if (isset($_SESSION['patient'])) {
    session_unset();
    session_destroy();
}
header('Location: ./');


?>