<?php include "backend.php" ?>
<?php include "nav.php" ?>
<?php include "eventtest.php" ?>
<!DOCTYPE html>
<html>

<head></head>

<body>


    <h3> Hello <?php echo $_SESSION['username'];?></h1>
    <form action="backend.php" method="post" name="logoutForm">
        <button type="submit" name="logout" value="Log out"> Log out </button>
    </form>
    
</body>

</html>