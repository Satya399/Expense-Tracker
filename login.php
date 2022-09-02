<?php session_start();
?>
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
          border-radius : 50px;
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
          #background-color : red;
        }
        .input-field input {
          padding : 10px;
          width: 100%;
          margin-top : 5px;
          border : none;
          border-bottom : 1px solid black;
        }
        .input-field span {
          font-weight : 500;
        }
        .doesnt_exists_error{
          color : red;
          #background-color: green;
          position : relative;
          left : 170px;
        }
        .submit{
          display : flex;
          justify-content: center;

        }
        .submit input {
          font-size : 20px;
          margin-top : 15px;
          width : 90px;
          background-color: transparent;
          border : 1px solid black;
        }
        .Registration {
          position : relative;
        }
        .New-here {
          position : absolute;
          bottom : 6px;
          right : 50px;
        }

    </style>
  </head>
  <body>
    <?php
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        if(filter_var($mail, FILTER_VALIDATE_EMAIL) === FALSE){
          $doesnt_exist = '* The mail is invalid';
        }
        else {

          include 'database_connect.php';
          $check = "SELECT * FROM `login details` WHERE mail REGEXP '^$mail$'; ";
          $conn->select_db('Expense Tracker');
          $result = $conn->query($check);
          if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if($row['password'] == $password){

              $conn->close();
              $_SESSION['username'] = $row['name'];
              $_SESSION['logged_in'] = true;
              header('Location: index.php');
              exit();
            }
            else{
              $password_error = '* Password is invalid';
              $conn->close();
            }
          }
          else{
            $doesnt_exist = '* The mail doesnt not exist';
            $conn->close();
            //header('Location: login.php');
          }
        }
      }
     ?>
    <div class="container">
      <div class="form">
        <div class="login">
            Login
        </div>
        <form class="Registration" action="login.php" method="post">
          <div class="all-input-fields">
            <div class="input-field">
              <span>Email Id</span>    <br><input type = 'text' placeholder = 'Enter your valid Email Id' name = 'mail' required>
            </div><div class="doesnt_exists_error">
              <?php if(isset($doesnt_exist)){echo $doesnt_exist;} ?>
            </div>
            <div class="input-field">
              <span>Password</span>  <br><input type = 'password' placeholder = 'Enter your Password' name = 'password' required>
              <div class="doesnt_exists_error">
                  <?php if(isset($password_error)){echo $password_error;} ?>
              </div>
            </div>
          </div>
          <div class="submit">
            <input type="submit" name="" value="Login">
          </div>
        </form>
      </div>
      <div class="New-here">
        <span><a href = "signUp.php">New here ? SignUp here</a></span>
      </div>
    </div>
  </body>

</html>
