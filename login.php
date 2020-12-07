<?php include "backend.php" ?>
<!DOCTYPE html>
<html>
<head></head>
<body>
  <form action="backend.php" method="post" name="LoginForm">
    <label for="username">Username:</label>
    <input type="text" name="username"><br>
    <label for="password">Password:</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Log In"><br>
  </form>
  <form action="register.php">
    New user?<br>
    <input type="submit" value="Register">
  </form>
</body>
</html>
