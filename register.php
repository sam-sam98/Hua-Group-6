<?php include "backend.php"?>
<!DOCTYPE html>
<html>
    <form ACTION="backend.php" METHOD="post" NAME="RegisterForm" ONSUBMIT="return (testEmpty() && testChars())">
        <label>Username:</label><br>
        <INPUT TYPE="text" NAME="username"><br>

        <label>Password:</label><br>
        <INPUT TYPE="password" NAME="pass1"><br>

        <label>Verify Password:</label><br>
        <INPUT TYPE="password" NAME="pass2"><br>

        <INPUT TYPE="submit" VALUE="Register">
    </form>
    <script type="text/javascript">
    function testEmpty() {
      registerForm = document.RegisterForm
      if((registerForm.username.value == "") || (registerForm.pass1.value == "") || registerForm.pass2.value == "") {
        alert('Please enter a username and password.');
        return false;
      } else return true;
    }
    </script>
    <script type="text/javascript">
    function testChars() {
      username = document.RegisterForm.username.value
      re = /[^a-z0-9_\-]/i
      if(username.search(re) == -1) {
        return true;
      } else {
        alert('Username can only contain underscores, hyphens, and alphanumeric characters.');
        return false;
      }
    }
    </script>
</html>
