<?php
include "backend.php";
unset($_SESSION['loginfail']);
echo ("<script>console.log(\"Login page request successful\");</script>");
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = md5(mysqli_real_escape_string($db, $_POST['password']));

$superadminlogin = "SELECT username FROM superadmin WHERE username = '$username' and password = '$password'";
$loginsql = "SELECT idParticipants FROM participants WHERE username = '$username' and password = '$password'";

if ($resultsa = mysqli_query($db, $superadminlogin) && $resultuser = mysqli_query($db, $loginsql)) {
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
  } else {
      $_SESSION['loginfail'] = "Username and password did not match. Please try again.";
      header("location: login.php");
  }
} else {
  echo ("<script>console.log(\"ERROR: Login page query failed\");</script>");
}
?>
