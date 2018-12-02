<?php

// server side validation
$email = $username = $password =  "";

$canContinue = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["username"])) {
    echo "<br> <p>Name is required </p>";
    $canContinue = false;
  } else {
    $username = test_input($_POST["username"]);
  }

  if (empty($_POST["password"])) {
    echo "<br> <p>Password is required </p>";
    $canContinue = false;
  } else {
    $password = test_input($_POST["password"]);
  }

  if (array_key_exists("email",$_POST)) {
    if (empty($_POST["email"])) {
      echo "<br> <p>Email is required </p>";
      $canContinue = false;
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<br> <p>Invalid email format </p>";
        $canContinue = false;
      }
    }
  }


  if (array_key_exists("email",$_POST) & $canContinue) {
    registerUser($email , $username , $password);
  }elseif (!array_key_exists("email",$_POST) & $canContinue) {
    loginUser($username , $password);
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

/*
* inserts new user into database and display inserted record id
*/
function registerUser($email , $username , $password){
  require "DBconnection.php";

  // $sql = 'INSERT INTO USER (email, username, password) VALUES ( " ' . $email . '","' . $username . '","' . $password . '")';

  $stmt = $conn->prepare("INSERT INTO USER (email, username, password , last_login_date) VALUES ( ? , ? , ? , CURRENT_TIMESTAMP)");

  //calculates md5 hash for password string
  $pswdMD5hash = md5($password);

  $stmt->bind_param("sss", $email , $username ,$pswdMD5hash ); //It is not recommended to use this function to secure passwords, due to the fast nature of this hashing algorithm.

  if ($stmt->execute() === TRUE) {
    $last_id = $conn->insert_id;
    echo "New record created successfully. Last inserted ID is: " . $last_id;
  } else {
    echo "Error: ". $stmt->error;
  }

  $stmt->close();
  $conn->close();
}

/*
* validates that the user is already registered and updates last_login_date of that user
*/
function loginUser($username , $password){
  require "DBconnection.php";

  $stmt = $conn->prepare("UPDATE USER SET last_login_date = CURRENT_TIMESTAMP WHERE username = ? AND password = ?");

  //calculates md5 hash for password string
  $pswdMD5hash = md5($password);

  $stmt->bind_param("ss", $username, $pswdMD5hash);//It is not recommended to use this function to secure passwords, due to the fast nature of this hashing algorithm.

  if ($stmt->execute() === TRUE && $stmt->affected_rows == 1) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}


?>
