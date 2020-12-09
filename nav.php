<?php include "session.php" ?>
<!DOCTYPE html>
<html>

<head></head>

<body>
  <?php
    if ($_SESSION['role'] == "super") {
      print('<div class="topnav">
        <a class="active" href="/index.php">Index</a>
        <a href="approval.php">Approve Events</a>
        <a href="superadmin-lookup">Event Lookup</a>
      </div>');
    }
    else{
      print('<div class="topnav">
        <a class="active" href="/index.php">Index</a>
        <a href="/eventmanage.php">Event Management</a>
        <a href="/event-lookup">Event Lookup</a>

      </div>');
    }
  ?>

</body>

</html>
