<?php include "backend.php";

$userid = $_SESSION['userid'];
$sql = "SELECT * FROM events WHERE idOrganizer = '$userid' AND approved = 1";
if ($result = mysqli_query($db, $sql)) {
  $n = mysqli_num_rows($result);
  if ($n > 0) {
    for($i = 0; $i < $n; $i++) {
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $eventid = $row['idEvents'];
      if (isset($_POST["event$i"])) {
        $deactivate = "UPDATE events SET approved = 2 WHERE idEvents = $eventid";
        if (mysqli_query($db, $deactivate)) {
          echo "<script>console.log(\"Event $eventid parameters updated.\");</script>";
        } else {
          echo "<script>console.log(\"ERROR: Failed to udate event $eventid!\");</script>";
        }
      }
    }
  }
  header("location: eventmanage.php");
} else {
  header("location: eventmanage.php?id=Submission error. Please try again.");
}
?>
