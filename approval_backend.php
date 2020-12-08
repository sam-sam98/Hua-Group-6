<?php
include "backend.php";
$getpending = "SELECT * FROM events WHERE approved = 0";
if ($resultpending = mysqli_query($db, $getpending)) {
  $n = mysqli_num_rows($resultpending);
  for ($i = 0; $i < $n; $i++) {
    $row = mysqli_fetch_array($resultpending, MYSQLI_ASSOC);
    $eventid = $row['idEvents'];
    echo "event id = $eventid";
    $verdict = $_POST["verdict$i"];

    if ($verdict == "approve") {
      $approve = "UPDATE events SET approved = 1 WHERE idEvents = $eventid";
      if ($result = mysqli_query($db, $approve)) {
        echo "<script>console.log(\"Event $eventid approved.\");</script>";
      } else {
        echo "<script>console.log(\"ERROR: Failed to approve event $eventid!\");</script>";
      }
    } else if ($verdict == "reject") {
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
