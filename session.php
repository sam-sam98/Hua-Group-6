<?php 
    $db = mysqli_connect('localhost', 'root', '', 'mydb');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $user = $_SESSION['username'];
    $role = $_SESSION['role'];

    if(!isset($user)){
        header("location: login.php");
        die();
    }
?>