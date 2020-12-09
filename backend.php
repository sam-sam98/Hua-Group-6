<?php
session_start();

$username = $pass1 = $pass2 = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'mydb'); // WARNING: Check password before running on your own server

//checking if server was connect successfully
if ($db->ping()) {
    echo ("<script>console.log(\"Our connection is ok!\");</script>");
} else {
    echo ("<script>console.log(\"DID NOT CONNECT TO DB: '$errors'\");</script>");
}

$superadminpass = md5("adminpassword");

$sqlsuperadmin = "INSERT INTO superadmin (username, password)
    SELECT username, password
    FROM (SELECT 'adminusername' as username, '$superadminpass' as password) t
    WHERE NOT EXISTS (SELECT 1 FROM superadmin u WHERE u.username = t.username);";

//Debugging to see if query was successful for superadmin insert
if (mysqli_query($db, $sqlsuperadmin)) {
    echo ("<script>console.log(\"Super Admin Added\");</script>");
} else {
    echo ("<script>console.log(\"ERROR: Super Admin was not added!\");</script>");
}

$adminpass = md5("testadmin");

$sqladmin = "INSERT INTO participants (username, password) VALUES ('testadmin', '$adminpass')";

$adminfrom = "SELECT * FROM participants WHERE username='testadmin' AND password='$adminpass'";


//Debugging to see if query was successful for superadmin insert
if (mysqli_query($db, $sqladmin)) {
    $result = mysqli_query($db, $adminfrom);
    if (mysqli_num_rows($result) == 1) {

        echo ("<script>console.log(\"Participant admin was found\");</script>");
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $iduser = $row['idParticipants'];

        $adminin = "INSERT INTO admins (idParticipants) VALUES ('$iduser')";

        if (mysqli_query($db, $adminin)) {
            echo ("<script>console.log(\"Admin Added\");</script>");
        } else {
            echo ("<script>console.log(\"ERROR: Admin was not added!\");</script>");
        }
    } else {
        echo ("<script>console.log(\"ERROR: Admin participant was not found!\");</script>");
    }
} else {
    echo ("<script>console.log(\"ERROR: Admin participant was not added!\");</script>");
}


$pass = md5("testuserpassword");

$sqlparticipant = "INSERT INTO participants (username, password) VALUES ('testusername', '$pass')";

//Debugging to see if query was successful for superadmin insert
if (mysqli_query($db, $sqlparticipant)) {
    echo ("<script>console.log(\"Participant Added\");</script>");
} else {
    echo ("<script>console.log(\"ERROR: Participant was not added!\");</script>");
}

$today = date("Y-m-d");

$eventDate = "SELECT * FROM events WHERE (approved = 1 and ('$today' NOT BETWEEN eventStart AND eventEnd))";
$eventResults = mysqli_query($db, $eventDate) or trigger_error(mysqli_error($db));
if(mysqli_num_rows($eventResults) > 0){
    for($i = 0; $i < mysqli_num_rows($eventResults); $i++){
        $eventRow = mysqli_fetch_array($eventResults, MYSQLI_ASSOC);
        $eventID = $eventRow['idEvents'];
        $unapprovesql = "UPDATE events SET approved = 3 WHERE idEvents = $eventID";
        if(mysqli_query($db, $unapprovesql)){
            echo ("<script>console.log(\"$eventID moved to unapproved\");</script>");
        }
    }
}

//getting post request from register page
if (isset($_POST['register'])) {

    echo ("<script>console.log(\"Registration page request successful\");</script>");

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
    $pass2 = mysqli_real_escape_string($db, $_POST['pass2']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }

    if (preg_match('/[^a-z_\-0-9]/i', $username)) {
        array_push($errors, "Username must contain only letters and numbers");
    }
    if (empty($pass1)) {
        array_push($errors, "Password is required");
    }

    if ($pass1 != $pass2) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $password = md5($pass1);
        $sql = "INSERT INTO participants (username, password) VALUES ('$username', '$password')";
        if(mysqli_query($db, $sql)) {
          header('location: login.php');
        } else {
          $_SESSION['regfail'] = "Username is already taken.";
          header('location: register.php');
        }
    } else {
        echo ("<script>console.log(\"ERROR: Registration page errors: '$errors'\");</script>");
    }
}

//logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login.php");
    exit();
}
?>
