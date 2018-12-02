<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="styles.css">

  <script>

  function validateField( str , type) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        switch (type) {
          case "email":
          document.getElementById("emailError").innerHTML = this.responseText;
          break;
          case "username":
          document.getElementById("usernameError").innerHTML = this.responseText;
          break;
        }

      }
    };

    xhttp.open("GET", "AJAXvalidate.php?" + type + "=" + str, true);
    xhttp.send();
  }

  </script>

</head>

<body>

  <form name="regForm" action="welcome.php"
  method="post" autocomplete="on">
  <div class="container">
    <h1>Sign Up</h1>
    <hr>
    <!-- client side validation using html required and type email -->
    <input type="email" placeholder="Email" name="email" onfocusout="validateField(this.value , this.name)" >
    <span class="error" id="emailError"></span>
    <input type="text" placeholder="Username" name="username" onfocusout="validateField(this.value , this.name)">
    <span class="error" id="usernameError"></span>
    <input type="password" placeholder="Password" name="password" >
    <input type="submit" value="Sign Up">
    <p id="login">Already a user ? <a href="login.php" >Log In</a></p>
  </div>
</form>

<p id="error"></p>

</body>


</html>
