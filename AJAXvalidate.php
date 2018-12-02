<?php

if (array_key_exists("email",$_REQUEST)){
  if (empty($_REQUEST["email"])) {
    echo "* Email is required";
  } else {
    $email = test_input($_REQUEST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "* Invalid email format";
    }else {
      require "DBconnection.php";
      $sql = "SELECT user_id FROM USER where email = '" . $email . "'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "* Email already exists";
      } else {
        echo "";
      }
      $conn->close();

    }
  }
}
if (array_key_exists("username",$_REQUEST)){
  if (empty($_REQUEST["username"])) {
    echo "* Name is required";
  } else {
    $username = test_input($_REQUEST["username"]);
    require "DBconnection.php";
    $sql = "SELECT user_id FROM USER where username = '" . $username . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "* Username already exists";
    } else {
      echo "";
    }
    $conn->close();
  }
}



/*
* trims the input and remove slashes
* htmlspecialchars() makes sure any characters that are special
* in html are properly encoded so people can't inject HTML tags
* or Javascript into the page.
*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
