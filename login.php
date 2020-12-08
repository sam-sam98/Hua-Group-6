
<?php include "backend.php" ?>
<?php include "errors.php" ?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <form action="backend.php" method="post" name="LoginForm" onsubmit="return testEmpty()">
    <label for="username">Username:</label>
    <input type="text" name="username"><br>
    <label for="password">Password:</label>
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
