<<<<<<< HEAD
<?php include "nav.php"; 
    $db = mysqli_connect('localhost', 'root', '', 'mydb');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $buttonflag = 0;

    $user = $_SESSION['username'];
    $role = $_SESSION['role'];

?>
=======
<?php include "nav.php" ?>


>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
<!DOCTYPE html>
<html>

<head></head>

<body>
    <h1>Search for Events</h1>
<<<<<<< HEAD
    <form action="event-lookup.php" method="GET" name="datelookupform">
=======
    <form action="event-lookup.php" method="post" name="datelookupform">
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
        <label for="startdatesearch">Start Date</label>
        <input type="date" name ="startdatesearch"/>
        <label for="enddatesearch">End Date</label>
        <input type="date" name ="enddatesearch"/>  
        <input type="submit" name="datesearch" value="Search Date"/>
    </form>
    <br>
<<<<<<< HEAD
    <form action="event-lookup.php" method="GET" name="citylookupform">
=======
    <form action="event-lookup.php" method="post" name="citylookupform">
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
        <label for="locsearch">City</label>
        <input type="search" name="locsearch"/>
        <input type="submit" name="citysearch" value="Search City"/>
    </form>
<<<<<<< HEAD
    <form action="eventlookup2.php" method="POST" name="participatelookupform">
    <?php 
    
    if(isset($_GET['datesearch'])){
        $startdatesearch = mysqli_real_escape_string($db, $_GET['startdatesearch']);
        $enddatesearch = mysqli_real_escape_string($db, $_GET['enddatesearch']);
        $datesql = "SELECT * FROM EVENTS WHERE (approved = 1 and ('$startdatesearch' BETWEEN eventStart and eventEnd) OR ('$enddatesearch' BETWEEN eventStart and eventEnd) OR (eventStart BETWEEN '$startdatesearch' and '$enddatesearch') OR (eventEnd BETWEEN '$startdatesearch' and '$enddatesearch'))";
        $result = mysqli_query($db, $datesql) or trigger_error(mysqli_error($db));
        $_SESSION['result'] = $datesql;

        $datedisplaystart = substr($startdatesearch, -5, 2)."-".substr($startdatesearch, -2)."-".substr($startdatesearch, -10, 4); 
        $datedisplayend = substr($startdatesearch, -5, 2)."-".substr($startdatesearch, -2)."-".substr($startdatesearch, -10, 4); 
        $buttonflag = 1;
        echo "<h3>Events from ".$datedisplaystart." to ".$datedisplayend."</h3>";      
        if(mysqli_num_rows( $result) > 0){
            for($i = 0; $i < mysqli_num_rows($result); $i++ ){
                $daterow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $eventurl = $daterow['eventURL'];
                $eventname = $daterow['eventName'];
                $eventDes = $daterow['eventDescription'];
                $eventCity = $daterow['eventCity'];
                $eventState = $daterow['eventState'];
                $datedisplaystart = substr($daterow['eventStart'], -5, 2)."-".substr($daterow['eventStart'], -2)."-".substr($daterow['eventStart'], -10, 4); 
                $datedisplayend = substr($daterow['eventEnd'], -5, 2)."-".substr($daterow['eventEnd'], -2)."-".substr($daterow['eventEnd'], -10, 4); 

                                
                $eventid = $daterow['idEvents'];
                $eventspartcipated = "SELECT * FROM eventsparticipated WHERE idEvents = '$eventid'";
                $partipatingresults = mysqli_query($db, $eventspartcipated) or trigger_error(mysqli_error($db));

                if(mysqli_num_rows($partipatingresults) == 0){
                    echo "<h3>$eventname</h3>
                    <p>$eventDes</p>
                    <p>Date: ".$datedisplaystart." to ".$datedisplayend."</p>
                    <a href='$eventurl'>Event Url</a> <input type=\"submit\" value='Participate' name=\"reserve$eventid\">";  
                }
                else{
                    echo "<h3>$eventname</h3>
                    <p>$eventDes</p>
                    <p>Date: ".$datedisplaystart." to ".$datedisplayend."</p>
                    <a href='$eventurl'>Event Url</a> <input type=\"submit\" value='Unreserve' name=\"unreserve$eventid\">";
                }
            }
        } 
        else{
            echo "No results";
        }
        
    }
    else if(isset($_GET['citysearch'])){
        $locsearch = mysqli_real_escape_string($db, $_GET['locsearch']);
        $locsql = "SELECT * FROM events WHERE eventCity = '$locsearch'  and approved = 1";
        $result = mysqli_query($db, $locsql) or trigger_error(mysqli_error($db));
        $_SESSION['result'] = $locsql;  
        if(mysqli_num_rows($result) > 0){
            echo "<h2>Events for $locsearch</h2>";
            for($i = 0; $i < mysqli_num_rows($result); $i++){
                $locrow = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $eventurl = $locrow['eventURL'];
                $eventname = $locrow['eventName'];
                $eventDes = $locrow['eventDescription'];

                $datedisplaystart = substr($locrow['eventStart'], -5, 2)."-".substr($locrow['eventStart'], -2)."-".substr($locrow['eventStart'], -10, 4); 
                $datedisplayend = substr($locrow['eventEnd'], -5, 2)."-".substr($locrow['eventEnd'], -2)."-".substr($locrow['eventEnd'], -10, 4);
                $eventid = $locrow['idEvents'];

                $eventspartcipated = "SELECT * FROM eventsparticipated WHERE idEvents = '$eventid'";
                $partipatingresults = mysqli_query($db, $eventspartcipated) or trigger_error(mysqli_error($db));

                $buttonflag = 1;
                if(mysqli_num_rows($partipatingresults) == 0){
                    echo "<h3>$eventname</h3>
                    <p>$eventDes</p>
                    <p>Date: ".$datedisplaystart." to ".$datedisplayend."</p>
                    <a href='$eventurl'>Event Url</a> <input type=\"submit\" value='Participate' name=\"reserve$eventid\">";  
                }
                else{
                    echo "<h3>$eventname</h3>
                    <p>$eventDes</p>
                    <p>Date: ".$datedisplaystart." to ".$datedisplayend."</p>
                    <a href='$eventurl'>Event Url</a> <input type=\"submit\" value='Unreserve' name=\"unreserve$eventid\">";
                }
            }
        }
        else{
            echo "No results";
        }
    }
    

?>
    </form>
=======
    <ul>
        <?php include "event-lookupbackend.php" ?>
    </ul>
    
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
</body>
</html>