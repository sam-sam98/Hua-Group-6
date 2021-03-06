<?php include "backend.php" ?>
<?php include "nav.php" ?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <form action="approval_backend.php" method="post" name="ApprovalForm">
    <?php
    $sql = "SELECT * FROM events WHERE approved = 0";
    if ($result = mysqli_query($db, $sql)) {
      $n = mysqli_num_rows($result);
      if ($n > 0) {
        echo "<h2>Event Applications</h2>";
        for ($i = 0; $i < $n; $i++) {
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          echo "<a href=" . $row['eventURL'] . "><span style=\"font-weight:bold;font-size:125%;\">" . $row['eventName'] . "</span></a><br>";
          echo "Location: " . $row['eventCity'] . ", " . $row['eventState'] . "<br>";
          echo "Dates: " . $row['eventStart'] . " to " . $row['eventEnd'] . "<br>";
          echo "Description: " . $row['eventDescription'] . "<br>";
          echo "<input type=\"radio\" name=\"verdict$i\" value=\"approve\">";
          echo "<label for=\"approve\">Approve</label>  ";
          echo "<input type=\"radio\" name=\"verdict$i\" value=\"reject\">";
          echo "<label for=\"reject\">Reject</label><br>";
          echo "<br>";
        }
        mysqli_free_result($result);
        echo "<input type=\"submit\" value=\"Confirm\">";
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