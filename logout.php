<?php
    //setcookie("loggedin", "", time() -60*60);
    require_once 'bootstrap/bootstrap.php';
    session_destroy();
    header('Location: login.php');
