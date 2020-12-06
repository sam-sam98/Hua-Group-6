<?php
    session_start();

    $username = $pass1 = $pass2 = "";
    $errors = array();

    $db = mysqli_connect('localhost', 'root', 'gr4ves1313', 'dbms');

    if (isset($_POST['Register'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
        $pass2 = mysqli_real_escape_string($db, $_POST['pass2']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (preg_match('/[^a-z_\-0-9]/i', $username)) {
            array_push($errors, "Username must contain only letters and numbers");
        }
        if (empty($pass1)) {
            array_push($errors, "Password is required");
        }

        if ($pass1 != $pass2) {
            array_push($errors, "The two passwords do not match");
        }

        if (count($errors) == 0) {
            $password = md5($pass1);
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
            mysqli_query($db, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        }
    }

    //logout
    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("location: login.php");
        exit();
    }

?>