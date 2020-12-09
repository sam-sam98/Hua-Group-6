<?php include "backend.php" ?>
<?php include "errors.php" ?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form ACTION="create_backend.php" METHOD="post" NAME="CreateEventsPage" ONSUBMIT="return (testEmpty() && testChars() && testPass())">
            <label>Event Name:</label>
            <INPUT type="text" name="eventName"><br>

            <label>Event URL:</label>
            <INPUT type="text" name="eventURL"><br>

            <label>Event City:</label>
            <INPUT type="text" name="eventCity"><br>

            <label>Event State:</label>
            <INPUT type="text" name="eventState"><br>

            <label>Event Description:</label>
            <INPUT type="text" name="eventDescription"><br>

            <label>Event Start Date:</label>
            <INPUT type="date" name="eventStart"><br>

            <label>Event End Date:</label>
            <INPUT type="date" name="eventEnd"><br>

            <INPUT type="submit" name="register" value="Submit Event">
        </form>
        <?php
        if (isset($_SESSION['createEventSuccess']))
        {
            echo("<h3>".$_SESSION['createEventSuccess']."</h3>");
            unset($_SESSION['createEventSuccess']);
        }
        ?>

        <button type="button" value="Back" onclick="location.href='eventmanage.php'">Back</button> 

    </body>
</html>

