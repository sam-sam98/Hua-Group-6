<?php include "backend.php" ?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <form action="approval_backend.php" method="post" name="ApprovalForm">
    <?php
    $getpending = "SELECT * FROM events WHERE approved = 0";
    if ($resultpending = mysqli_query($db, $getpending)) {
      $n = mysqli_num_rows($resultpending);
      if ($n > 0) {
        for ($i = 0; $i < $n; $i++) {
          $row = mysqli_fetch_array($resultpending, MYSQLI_ASSOC);
          echo "<h2>" . $row['eventName'] . "</h2>";
          echo "Location: " . $row['eventAddress'] . "<br>";
          echo "Dates: " . $row['eventStart'] . " to " . $row['eventEnd'] . "<br>";
          echo "Description: " . $row['eventDescription'] . "<br>";
          echo "<input type=\"radio\" name=\"verdict$i\" value=\"approve\">";
          echo "<label for=\"approve\">Approve</label>  ";
          echo "<input type=\"radio\" name=\"verdict$i\" value=\"reject\">";
          echo "<label for=\"reject\">Reject</label><br>";
        }
        mysqli_free_result($resultpending);
        echo "<br><input type=\"submit\" value=\"Confirm\">";
        echo "<input type=\"reset\" value=\"Clear\">";
      } else {
        echo "No pending event forms.";
      }
    } else {
      echo "No pending event forms.";
    }
    ?>
  </form>
  <form action="index.php" method="post">
    <input type="submit" value="Back">
  </form>
</body>
</html>
