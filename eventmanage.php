<?php include "backend.php" ?>
<?php include "nav.php" ?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <br>
  <?php
  if ($_SESSION['role'] == "participant") {
    echo "Create an event to get started!";
  }
  ?>
  <form action="create.php" method="post">
    <input type="submit" value="Create New Event">
  </form>
  <?php
  if ($_SESSION['role'] == "admin") {
    echo "<h2>Active Events</h2>";
    echo "<form action=\"eventmanage_backend.php\" method=\"post\" name=\"EventsForm\">";
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM events WHERE idOrganizer = '$userid' AND approved = 1";
    if ($result = mysqli_query($db, $sql)) {
      $n = mysqli_num_rows($result);
      if ($n > 0) {
        for($i = 0; $i < $n; $i++) {
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          echo "<input type=\"checkbox\" id=\"event$i\" name=\"event$i\" value=\"delete\">  ";
          echo "<a href=" . $row['eventURL'] . "><span style=\"font-weight:bold;font-size:125%;\">" . $row['eventName'] . "</span></a><br>";
          echo "Location: " . $row['eventCity'] . ", " . $row['eventState'] . "<br>";
          echo "Dates: " . $row['eventStart'] . " to " . $row['eventEnd'] . "<br>";
          echo "Description: " . $row['eventDescription'] . "<br>";
          echo "<br>";
        }
        echo "<input type=\"submit\" value=\"Deactivate\">";
        echo "<input type=\"reset\" value=\"Clear\">";
      } else {
        echo "No currently active events.";
      }
    } else {
      echo "Could not retrieve event list.";
    }
    echo "</form>";
    echo "<button onclick=\"toggleInactive()\">Toggle Inactive</button>";
    echo "<div id=\"Inactive\" style=\"display:none;\">";
    echo "<h2>Inactive Events</h2>";
    $sql = "SELECT * FROM events WHERE idOrganizer AND NOT approved = 1";
    if ($result = mysqli_query($db, $sql)) {
      $n = mysqli_num_rows($result);
      if ($n > 0) {
        for ($i = 0; $i < $n; $i++) {
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          echo "<a href=" . $row['eventURL'] . "><span style=\"font-weight:bold;font-size:125%;\">" . $row['eventName'] . "</span></a><br>";
          if ($row['approved'] == 0) {
            echo "Status: <span style=\"color:d1b61d;\">Pending Approval</span><br>";
          } else {
            echo "Status: <span style=\"color:#d11d1d;\">Deactivated</span><br>";
          }
          echo "Location: " . $row['eventCity'] . ", " . $row['eventState'] . "<br>";
          echo "Dates: " . $row['eventStart'] . " to " . $row['eventEnd'] . "<br>";
          echo "Description: " . $row['eventDescription'] . "<br>";
          echo "<br>";
        }
      } else {
        echo "No inactive events.";
      }
    } else {
      echo "Could not retrieve event list.";
    }
    echo "</div>";
  }
  ?>
  <script type="text/javascript">
  function toggleInactive() {
    inactive = document.getElementById("Inactive");
    if (inactive.style.display == "none") {
      inactive.style.display = "block";
    } else {
      inactive.style.display = "none";
    }
  }
  </script>
</body>
</html>