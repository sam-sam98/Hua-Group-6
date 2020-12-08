<?php include "session.php" ?>
<!DOCTYPE html>
<html>

<head></head>

<body>
  <?php

    if ($role == "super") {
      print('<div class="topnav">
        <a class="active" href="/index.php">Index</a>
        <a href="/approve-events.php">Approve Events</a>
        <a href="/event-adminlookup.php">Event Lookup</a>
      </div>');
    }
    else{
      print('<div class="topnav">
        <a class="active" href="/index.php">Index</a>
        <a href="/manage-events.php">Event Management</a>
        <a href="/event-lookup.php">Event Lookup</a>
      </div>');
    }
  ?>

</body>

</html>