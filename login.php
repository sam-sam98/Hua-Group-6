
<?php include "backend.php" ?>
<?php include "errors.php" ?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <?php
  if (isset($_SESSION['loginfail'])) {
    echo "<h4>" . $_SESSION['loginfail'] . "</h4>";
    unset($_SESSION['loginfail']);
  }
  if (isset($_SESSION['attemptcounter'])) {
    if ($_SESSION['attemptcounter'] >= 5) {
      echo "<h4>Too many failed attempts. Please try again later.</h4>";
    }
  }
  ?>
  <form action="login_backend.php" method="post" name="LoginForm" onsubmit="return testEmpty()">
    <label for="username">Username:</label><br>
    <input type="text" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password"><br>
    <input type="submit" value="Log In" name="Login"><br>
  </form>
  <form action="register.php">
    New user?<br>
    <input type="submit" value="Register">
  </form>
  <script type="text/javascript">
  // Halts submission if fields are empty
  function testEmpty() {
    loginForm = document.LoginForm
    if((loginForm.username.value == "") || (loginForm.password.value == "")) {
      alert('Please enter a username and password.');
      return false;
    } else return true;
  }
  </script>
</body>
</html>
