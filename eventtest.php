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

   // $eventInsert = "INSERT INTO 'events' ('eventCity', 'eventURL', 'eventDescription', 'eventEnd', 'eventName', 'eventStart', 'eventState') 
    //VALUES ('Orlando', 'https://seaworld.com/orlando/events/christmas-celebration/', 'Seaworld Christmas Event', '2020-12-31', 'Seaworld's Christmas Celebration', '2020-11-14', 'Florida')";
    
    $eventInsert = "INSERT INTO events (eventName, eventCity, eventDescription, eventStart, eventEnd, eventState, eventURL) VALUES ('Seaworlds Christmas Celebration', 'Orlando', 'Seaworld Christmas Event', '20201114', '20201231', 'Florida', 'https://seaworld.com/orlando/events/christmas-celebration/')";
    if(mysqli_query($db, $eventInsert)){
        echo ("<script>console.log(\"Event Added\");</script>");
    } else {
        echo ("<script>console.log(\"ERROR: Event was not added!\");</script>");
    }

    $eventInsert = "INSERT INTO events (eventName, eventCity, eventDescription, eventStart, eventEnd, eventState, eventURL) VALUES ('Pompeii: The Immortal City', 'Orlando', 'Orlando Science Center exhibit of Pompeii', '20201026', '20210124', 'Florida', 'https://www.osc.org/pompeii/')";
    if(mysqli_query($db, $eventInsert)){
        echo ("<script>console.log(\"Event Added\");</script>");
    } else {
        echo ("<script>console.log(\"ERROR: Event was not added!\");</script>");
    }


?>