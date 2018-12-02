<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="styles.css">

  <script>

  //client side validation using javascript
  function validateForm() {
    var form = document.forms["regForm"];
    var email = form.elements["email"].value.trim();
    var username = form.elements["username"].value.trim();
    var password = form.elements["password"].value.trim();

    if (!validateEmail(email) || username.length == 0 || password.length == 0) {
      return false;
    }

  }

  //regex to validate email
  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

}

  </script>

</head>

<body>

  <form name="regForm" action="welcome.php"
  method="post" onsubmit="return validateForm()" autocomplete="on">
  <div class="container">
    <h1>Sign Up</h1>
    <hr>
    <!-- client side validation using html required and type email -->
    <input type="email" placeholder="Email" name="email" required >
    <input type="text" placeholder="Username" name="username" required>
    <input type="password" placeholder="Password" name="password" required>
    <input type="submit" value="Sign Up">
    <p id="login">Already a user ? <a href="login.php" >Log In</a></p>
  </div>
</form>

</body>


</html>
