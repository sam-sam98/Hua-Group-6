<?php 
    $db = mysqli_connect('localhost', 'root', '', 'mydb');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $user = $_SESSION['username'];
    $role = $_SESSION['role'];


    if(isset($_POST['datesearch'])){
        $startdatesearch = mysqli_real_escape_string($db, $_POST['startdatesearch']);
        $enddatesearch = mysqli_real_escape_string($db, $_POST['enddatesearch']);
        $datesql = "SELECT * FROM EVENTS WHERE (('$startdatesearch' BETWEEN eventStart and eventEnd) OR ('$enddatesearch' BETWEEN eventStart and eventEnd) OR (eventStart BETWEEN '$startdatesearch' and '$enddatesearch') OR (eventEnd BETWEEN '$startdatesearch' and '$enddatesearch'))";
        $dateresult = mysqli_query($db, $datesql) or trigger_error(mysqli_error($db));

        $datedisplaystart = substr($startdatesearch, -5, 2)."-".substr($startdatesearch, -2)."-".substr($startdatesearch, -10, 4); 
        $datedisplayend = substr($startdatesearch, -5, 2)."-".substr($startdatesearch, -2)."-".substr($startdatesearch, -10, 4); 

        echo "<h3>Events from ".$datedisplaystart." to ".$datedisplayend."</h3>";      
        if(mysqli_num_rows( $dateresult) > 0){
            for($i = 0; $i < mysqli_num_rows($dateresult); $i++ ){
                $daterow = mysqli_fetch_array($dateresult, MYSQLI_ASSOC);
                $eventurl = $daterow['eventURL'];
                $eventname = $daterow['eventName'];
                $eventDes = $daterow['eventDescription'];
                $eventCity = $daterow['eventCity'];
                $eventState = $daterow['eventState'];
                $datedisplaystart = substr($daterow['eventStart'], -5, 2)."-".substr($daterow['eventStart'], -2)."-".substr($daterow['eventStart'], -10, 4); 
                $datedisplayend = substr($daterow['eventEnd'], -5, 2)."-".substr($daterow['eventEnd'], -2)."-".substr($daterow['eventEnd'], -10, 4); 

                echo "<li><h3>$eventname</h3><p>$eventDes</p><p>Location: ".$eventCity.", ".$eventState."<p>Date: ".$datedisplaystart." to ".$datedisplayend."</p><a href='$eventurl'>Event Url</a></li>";     
            }
        } 
        else{
            echo "No results";
        }
        
        unset($_POST['datesearch']);
    }
    else if(isset($_POST['citysearch'])){
        $locsearch = mysqli_real_escape_string($db, $_POST['locsearch']);
        $locsql = "SELECT * FROM events WHERE eventCity = '$locsearch'";
        $locresult = mysqli_query($db, $locsql) or trigger_error(mysqli_error($db));   
        if(mysqli_num_rows($locresult) > 0){
            echo "<h2>Events for $locsearch</h2>";
            for($i = 0; $i < mysqli_num_rows($locresult); $i++){
                $locrow = mysqli_fetch_array($locresult, MYSQLI_ASSOC);
                $eventurl = $locrow['eventURL'];
                $eventname = $locrow['eventName'];
                $eventDes = $locrow['eventDescription'];

                $datedisplaystart = substr($locrow['eventStart'], -5, 2)."-".substr($locrow['eventStart'], -2)."-".substr($locrow['eventStart'], -10, 4); 
                $datedisplayend = substr($locrow['eventEnd'], -5, 2)."-".substr($locrow['eventEnd'], -2)."-".substr($locrow['eventEnd'], -10, 4);

                echo "<li><h3>$eventname</h3><p>$eventDes</p><p>Date: ".$datedisplaystart." to ".$datedisplayend."</p><a href='$eventurl'>Event Url</a></li>"; 
            }
        }
        else{
            echo "No results";
        }
    }

?>