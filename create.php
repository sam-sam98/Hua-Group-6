<?php include "backend.php" ?>
<?php include "errors.php" ?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <form ACTION="create_backend.php" METHOD="post" NAME="CreateEventsPage" ONSUBMIT="return testEmpty()">
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
        <script type="text/javascript">
        function testEmpty() {
          form = document.CreateEventsPage
          if ((form.eventName.value == "") || (form.eventURL.value == "") || (form.eventCity.value == "") || (form.eventState.value == "") || (form.eventStart.value == "") || (form.eventEnd.value == "")) {
            alert("Please fill out all fields.");
            return false;
          } else {
            return true;
          }
        }
        </script>
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
