<?php 
    $db = mysqli_connect('localhost', 'root', '', 'mydb');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $user = $_SESSION['username'];
    $role = $_SESSION['role'];


    if(isset($_POST['participantsearch'])){
        $participant = mysqli_real_escape_string($db, $_POST['participantlookup']);
        $participantsql = "SELECT events.eventName FROM participants, eventsparticipated, events WHERE (participants.username = '$participant' AND eventsparticipated.idParticipants = participants.idParticipants AND events.idEvents = eventsparticipated.idEvents)";
        $participantresult = mysqli_query($db, $participantsql) or trigger_error(mysqli_error($db));
     
        if(mysqli_num_rows( $participantresult) > 0){
            echo "<h2>Events $participant has particpated in</h2>";
            // Add list of events user has participated in.
            for ($i = 0; $i < mysqli_num_rows($participantresult); $i++) {
                $daterow = mysqli_fetch_array($participantresult, MYSQLI_ASSOC);
                $eventname = $daterow['eventName'];

                echo "<li><h3>$eventname</h3></li>";
            }
        }else{
            echo "No results";
        }
        
        unset($_POST['participantsearch']);
    }
    else if(isset($_POST['adminsearch'])){
        $adminsearch = mysqli_real_escape_string($db, $_POST['adminlookup']);
        $adminsql = "SELECT events.eventName, events.eventDescription, events.eventCity, events.eventState, events.eventStart, events.eventEnd, events.eventURL FROM participants, admins, events WHERE participants.username = '$adminsearch' AND admins.idParticipants = participants.idParticipants AND admins.idParticipants = events.idOrganizer";
        $adminresult = mysqli_query($db, $adminsql) or trigger_error(mysqli_error($db));   
        if(mysqli_num_rows($adminresult) > 0){
            echo "<h2>Events organized by $adminsearch</h2>";
            for ($i = 0; $i < mysqli_num_rows($adminresult); $i++) {
                $daterow = mysqli_fetch_array($adminresult, MYSQLI_ASSOC);
                $eventurl = $daterow['eventURL'];
                $eventname = $daterow['eventName'];
                $eventDes = $daterow['eventDescription'];
                $eventCity = $daterow['eventCity'];
                $eventState = $daterow['eventState'];
                $datedisplaystart = substr($daterow['eventStart'], -5, 2) . "-" . substr($daterow['eventStart'], -2) . "-" . substr($daterow['eventStart'], -10, 4);
                $datedisplayend = substr($daterow['eventEnd'], -5, 2) . "-" . substr($daterow['eventEnd'], -2) . "-" . substr($daterow['eventEnd'], -10, 4);

                echo "<li><h3>$eventname</h3><p>$eventDes</p><p>Location: " . $eventCity . ", " . $eventState . "<p>Date: " . $datedisplaystart . " to " . $datedisplayend . "</p><a href='$eventurl'>Event Url</a></li>";
        }
        }
        else{
            echo "No results";
        }
<<<<<<< HEAD
    }
=======
    }
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
