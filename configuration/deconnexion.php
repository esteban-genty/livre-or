<?php
    session_start();
    session_unset();
    session_destroy();
    header('Location: /livre-or/views/index.php');
    exit();
?>