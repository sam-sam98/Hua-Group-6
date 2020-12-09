<?php
$db = mysqli_connect('localhost', 'root', '', 'mydb');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$buttonflag = 0;

$user = $_SESSION['username'];
$role = $_SESSION['role'];
$id = $_SESSION['userid'];
$prevPage = $_SERVER['HTTP_REFERER'];

        $resql = $_SESSION['result'];
        $result = mysqli_query($db, $resql);
        if(mysqli_num_rows($result) > 0){
            for($i = 0; $i < mysqli_num_rows($result); $i++){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $eventid = $row['idEvents'];
                if(isset($_POST["reserve$eventid"])){
                    echo "<script>console.log(\"reserved $eventid\");</script>";
                    $particpatesql = "INSERT INTO eventsparticipated (idEvents, idParticipants) VALUES ('$eventid','$id')";
                    $resultparticipate = mysqli_query($db, $particpatesql) or trigger_error(mysqli_error($db));
                    if($resultparticipate){
                        header("location: $prevPage");
                    }
                }
                else if(isset($_POST["unreserve$eventid"])){
                    echo "<script>console.log(\"unreserved $eventid\");</script>";
                    $unreservesql = "DELETE FROM eventsparticipated WHERE idEvents = '$eventid' and idParticipants = '$id'";
                    $unreserveresult = mysqli_query($db, $unreservesql) or trigger_error(mysqli_error($db));
                    if($unreserveresult){
                        header("location: $prevPage");
                    }
                    
                }
                else{
                    echo "<script>console.log(\"Did nothing $eventid\");</script>";
                }
            }
        }
    ?> 