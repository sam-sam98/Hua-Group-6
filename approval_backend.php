<?php
include "backend.php";
$getpending = "SELECT * FROM events WHERE approved = 0";
if ($resultpending = mysqli_query($db, $getpending)) {
  $n = mysqli_num_rows($resultpending);
  for ($i = 0; $i < $n; $i++) {
    $row = mysqli_fetch_array($resultpending, MYSQLI_ASSOC);
    $eventid = $row['idEvents'];
    $eventadmin = $row['idOrganizer'];
    $verdict = $_POST["verdict$i"];

    // On selection of approve
    if ($verdict == "approve") {
      // Search for organizer on admin table
      $approve = "SELECT * FROM admins WHERE idParticipants = $eventadmin";
      if (mysqli_query($db, $approve)) {
        // Promote user to admin if they are not already on the admin table
        if (mysqli_num_rows($result) == 0) {
          $approve = "INSERT INTO admins (idParticipants) VALUES ('$eventadmin')";
          if (mysqli_query($db, $approve)) {
            echo "<script>console.log(\"Admin $eventadmin created.\");</script>";
          } else {
            echo "<script>console.log(\"ERROR: Failed to create admin $eventadmin!\");</script>";
          }
        }
        // Set event to approved
        $approve = "UPDATE events SET approved = 1 WHERE idEvents = $eventid";
        if (mysqli_query($db, $approve)) {
          echo "<script>console.log(\"Event $eventid approved.\");</script>";
        } else {
          echo "<script>console.log(\"ERROR: Failed to approve event $eventid!\");</script>";
        }
      } else {
        echo "<script>console.log(\"ERROR: Failed to retreive event organizer $eventadmin!\");</script>";
      }
    // On selection of reject
    } else if ($verdict == "reject") {
      // Delete event from table
      $reject = "DELETE FROM events WHERE idEvents = $eventid";
      if ($result = mysqli_query($db, $reject)) {
        echo "<script>console.log(\"Event $eventid rejected.\");</script>";
      } else {
        echo "<script>console.log(\"ERROR: Failed to reject event $eventid!\");</script>";
      }
    }
  }
  header("location: approval.php");
} else {
  header("location: approval.php?id=Submission error. Please try again.");
}
?>
