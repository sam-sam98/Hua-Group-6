<?php
$db = mysqli_connect('localhost', 'root', '', 'mydb');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
<<<<<<< HEAD

=======
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
unset($_SESSION['loginfail']);
echo ("<script>console.log(\"Login page request successful\");</script>");
if ($_SESSION['attemptcounter'] >= 5) {
  header("location: login.php");
} else {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = md5(mysqli_real_escape_string($db, $_POST['password']));

  $superadminlogin = "SELECT username FROM superadmin WHERE username = '$username' and password = '$password'";
  $loginsql = "SELECT idParticipants FROM participants WHERE username = '$username' and password = '$password'";

  $resultsuper = mysqli_query($db, $superadminlogin) or trigger_error(mysqli_error($db));
  $resultuser = mysqli_query($db, $loginsql);

  if (mysqli_num_rows($resultsuper) == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = "super";
    //might change to special index for superadmin and do a separate php check there to make sure its the super admin
    header("location: index.php");
  } else if (mysqli_num_rows($resultuser) == 1) {
    $row = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);
    $iduser = $row['idParticipants'];
    $_SESSION['userid'] = $iduser;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = "participant";

    $adminlogin = "SELECT idParticipants FROM admins WHERE idParticipants = '$iduser'";
    $result = mysqli_query($db, $adminlogin);
    if(mysqli_num_rows($result) == 1 ){
      $_SESSION['role'] = "admin";
    } else {
      $_SESSION['role'] = "participant";
    }
    $_SESSION['attemptcounter'] = 0;
    header("location: index.php");
  }  else {
      $_SESSION['loginfail'] = "Username and password did not match. Please try again.";
      $_SESSION['attemptcounter'] += 1;
      header("location: login.php");
  }
}



<<<<<<< HEAD
$resultsuper = mysqli_query($db, $superadminlogin) or trigger_error(mysqli_error($db));
$resultuser = mysqli_query($db, $loginsql);

if (mysqli_num_rows($resultsuper) == 1) {
  $_SESSION['username'] = $username;
  $_SESSION['role'] = "super";
  //might change to special index for superadmin and do a separate php check there to make sure its the super admin
  header("location: index.php");
} else if (mysqli_num_rows($resultuser) == 1) {
  $row = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);
  $iduser = $row['idParticipants'];
  $_SESSION['userid'] = $iduser;
  $_SESSION['username'] = $username;
  $_SESSION['role'] = "participant";
  
  $adminlogin = "SELECT idParticipants FROM admins WHERE idParticipants = '$iduser'";
  $result = mysqli_query($db, $adminlogin);
  if(mysqli_num_rows($result) == 1 ){
    $_SESSION['role'] = "admin";
=======



/*if ($resultsa = mysqli_query($db, $superadminlogin)) {
  // test if super admin
  if (mysqli_num_rows($resultsa) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['role'] = "super";
      //might change to special index for superadmin and do a separate php check there to make sure its the super admin
      header("location: index.php");
  // test if user exists
  } else if (mysqli_num_rows($resultuser) == 1) {
      $row = mysqli_fetch_array($resultuser, MYSQLI_ASSOC);
      $iduser = $row['idParticipants'];
      $_SESSION['userid'] = $iduser;
      $_SESSION['username'] = $username;
      // test if user is admin
      $adminlogin = "SELECT idParticipants FROM admins WHERE idParticipants = '$iduser'";
      $result = mysqli_query($db, $adminlogin);
      if(mysqli_num_rows($result) == 1 ){
        $_SESSION['role'] = "admin";
      } else {
        $_SESSION['role'] = "participant";
      }
      header("location: index.php");
  // Return user to login
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
  } else {
    $_SESSION['role'] = "participant";
  }
<<<<<<< HEAD
  header("location: index.php");
}
  else {
    $_SESSION['loginfail'] = "Username and password did not match. Please try again.";
    header("location: login.php");
}
=======
} else {
  echo ("<script>console.log(\"ERROR: Login page query failed\");</script>");
}*/
>>>>>>> e8efbd95674d7ca96d789f8495196628e4ba9db0
?>
