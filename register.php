<?php include "backend.php" ?>
<?php include "errors.php" ?>
<!DOCTYPE html>
<html>
    <form ACTION="backend.php" METHOD="post" NAME="RegisterForm" ONSUBMIT="return (testEmpty() && testChars() && testPass())">
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

    function testPass() {
      pass1 = document.RegisterForm.pass1.value
      pass2 = document.RegisterForm.pass2.value
      if(pass1 == pass2) {
          return true;
      } else {
        alert('Passwords must match.');
        return false;
      }
    }
    </script>
</html>
