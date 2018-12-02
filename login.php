<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">

  <script>

  //client side validation using javascript
  function validateForm() {
    var form = document.forms["regForm"];
    var username = form.elements["username"].value.trim();
    var password = form.elements["password"].value.trim();

    if (username.length == 0 || password.length == 0) {
      return false;
    }

  }

  </script>

</head>
<body>

  <form name="regForm" action="welcome.php"
  method="post" onsubmit="return validateForm()" autocomplete="on">
  <div class="container">
    <h1>Log In</h1>
    <hr>
    <!-- client side validation using html required and type email -->
    <input type="text" placeholder="Username" name="username" required>
    <input type="password" placeholder="Password" name="password" required>
    <input type="submit" value="Log In">
    <p id="login">Create an account ? <a href="registration.php" >Sign Up</a></p>
  </div>
</form>

</body>
</html>
