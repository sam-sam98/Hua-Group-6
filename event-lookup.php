<?php include "nav.php" ?>


<!DOCTYPE html>
<html>

<head></head>

<body>
    <h1>Search for Events</h1>
    <form action="event-lookup.php" method="post" name="datelookupform">
        <label for="startdatesearch">Start Date</label>
        <input type="date" name ="startdatesearch"/>
        <label for="enddatesearch">End Date</label>
        <input type="date" name ="enddatesearch"/>  
        <input type="submit" name="datesearch" value="Search Date"/>
    </form>
    <br>
    <form action="event-lookup.php" method="post" name="citylookupform">
        <label for="locsearch">City</label>
        <input type="search" name="locsearch"/>
        <input type="submit" name="citysearch" value="Search City"/>
    </form>
    <ul>
        <?php include "event-lookupbackend.php" ?>
    </ul>
    
</body>
</html>