<?php include "backend.php" ?>
<?php include "errors.php" ?>
<!DOCTYPE html>
<html>
  <?php
  if (isset($_SESSION['regfail'])) {
    echo "<h4>" . $_SESSION['regfail'] . "</h4>";
    unset($_SESSION['regfail']);
  }
  ?>
    <form ACTION="backend.php" METHOD="post" NAME="RegisterForm" ONSUBMIT="return (testEmpty() && testChars() && testPass())">
        <label>Username:</label><br>
        <INPUT type="text" name="username"><br>

        <label>Password:</label><br>
        <INPUT type="password" name="pass1"><br>

        <label>Verify Password:</label><br>
        <INPUT type="password" name="pass2"><br>

        <INPUT type="submit" name="register" value="Register">
    </form>
    <div>
      <p>Already have an account?<p>
      <button type="button" value="Login" onclick="location.href='login.php'">Login</button>
    </div>


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
