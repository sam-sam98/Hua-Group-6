<?php

    $db = mysqli_connect('localhost', 'root', '', 'mydb');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $eventName = mysqli_real_escape_string($db, $_POST['eventName']);
    $eventURL = mysqli_real_escape_string($db, $_POST['eventURL']);
    $eventCity = mysqli_real_escape_string($db, $_POST['eventCity']);
    $eventState = mysqli_real_escape_string($db, $_POST['eventState']);
    $eventDescription = mysqli_real_escape_string($db, $_POST['eventDescription']);
    $eventStart = mysqli_real_escape_string($db, $_POST['eventStart']);
    $eventEnd = mysqli_real_escape_string($db, $_POST['eventEnd']);
    $userid = $_SESSION['userid'];

    $sqlevent = "INSERT INTO events (eventName, eventURL, eventCity, eventState, eventDescription, eventStart, eventEnd, idOrganizer) VALUES ('$eventName', '$eventURL', '$eventCity', '$eventState', '$eventDescription', '$eventStart', '$eventEnd', '$userid')";

    if (mysqli_query($db, $sqlevent)) {
        $_SESSION['createEventSuccess'] = "Event Created!";
        //echo ("<script>console.log(\"Event was created succesfully!\");</script>");
        header('location: create.php');

    } else {
        $_SESSION['createEventSuccess'] = "Event NOT Created!";
        //echo ("<script>console.log(\"ERROR: Event was NOT created successfully!\");</script>");
        header('location: create.php');
    }
    


?>