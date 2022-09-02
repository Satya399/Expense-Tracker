<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp and Login</title>
    <style media="screen">
        * {
          box-sizing : border-box;
          padding : 0;
          margin : 0;
        }
        body {
          height : 100vh;
          display : flex;
          align-items : center;
          justify-content : center;
          background-color : #00FFFF;
        }
        .container {
          position : relative;
          max-width : 450px;
          width : 100%;
          background-color : white;
          border-style : solid;
          border-color : black;
          border-radius : 20px;
        }
        .container .form{
          padding : 50px;
        }
        .container .login {
          font-size : 30px;
          font-weight : 800;
        }
        .input-field {
          position : relative;
          margin-top : 30px;
          #border : 2px solid black;
        }
        .input-field input {
          padding : 10px;
          width: 100%;
          margin-top : 5px;
          border : none;
          border-bottom : 1px solid black;
        }

        .already_exists_error {
          color : red;
          position : relative;
          #background-color: green;
          left : 175px;
          font-size : 14px;
        }
        .Registration {
          position : relative;
        }
        .Already-a-user {
          position : absolute;
          bottom : 6px;
          right : 50px;
        }
        .signup{
          display :flex;
          justify-content: center;
          #border : 2px solid black;
          margin-top : 20px;
        }
        .signup input{
          font-size : 20px;
          width : 30%;

        }

    </style>
  </head>
  <body>
    <?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        echo "The details you entered are $name, $mail, $password";
        include 'database_connect.php';
        $pattern = "SELECT * FROM `login details` WHERE mail REGEXP '^$mail$';";
        $insert = "INSERT INTO `login details` (name, mail, password) VALUES ('$name', '$mail', '$password');";
        $conn->select_db('Expense Tracker');
        $check_for_mail = $conn->query($pattern);
        if($check_for_mail->num_rows > 0){
          $already_exists_error = 'The mail id already exists';
          $conn->close();
          //header("Location: signUp.php");
        }
        else {
          if($conn->query($insert) == FALSE){
            echo "Unable to complete your request!, Error occured : " . $conn->error;
          }
          else{
            $_SESSION['username'] = $name;
          }
          $conn->close();
          header('Location: index.php');

        }

    }
    ?>
    <div class="container">
      <div class="form">
        <div class="login">
            Sign Up
        </div>
        <form class="Registration" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
          <div class="all-input-fields">
            <div class = 'input-field'><span>Full Name </span><br><input type = 'text' name ='name' placeholder = 'Enter your full name' required></div>
            <div class="input-field">
              <span>Email Id</span>    <br><input type = 'text' placeholder = 'Enter your valid Email Id' name = 'mail' required> <div class = 'already_exists_error'>
                <?php if(isset($already_exists_error)){echo "* $already_exists_error";} ?> </div>
            </div>
            <div class="input-field">
              <span>Password</span>  <br><input type = 'password' placeholder = 'Enter your Password' name = 'password' required>
            </div>
          </div>
          <div class="signup">
            <input type="submit" name="" value="SignUp">
          </div>
        </form>
      </div>
      <div class="Already-a-user">
        <span><a href = "login.php">Already a user ? Login here</a></span>
      </div>
    </div>


  </body>
</html>
