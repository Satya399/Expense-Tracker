<?php session_start();
  if(!isset($_SESSION['logged_in'])){
    header('Location: login.php');
    exit();
  }
?>


<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>Expense Tracker</title>
        <link rel="stylesheet" href="style.css">
        <style media="screen">
          .username {
            border : 1px solid black;
            background-color : green;
          }
        </style>
    </head>
    <body>
        <h2>Expense Tracker</h2>
        <div class="menu">
            <ua>
                <li><a href="#">HOME</a></li>
                <li><a href="#">ABOUT</a></li>
                <li><a href="#">SERVICE</a></li>
                <li><a href="#">DESIGN</a></li>
                <li><a href="#">CONTACT</a></li>
                <li><a href="logout.php">LOGOUT</a></li>
            </ua>

        </div>
        <div class="username">
          <?php echo $_SESSION['username'];
          ?>
        </div>
        <div class="container">
            <h3>YOUR BALANCE</h3>
            <h1 id="balance">Rs0.00</h1>

            <div class="inc-exp-container">
                <div>
                    <h4>INCOME</h4>
                    <p id="money-plus" class="money-plus">
                        +Rs0.00
                    </p>
                </div>
                <div>
                    <h4> EXPENSE</h4>
                    <p id="money-minus" class="money-minus">
                        -Rs0.00
                    </p>
                </div>


    </div>
        <h3>HISTORY</h3>
        <ul id="list" class="list">
            <li class="minus">
                Cash <span>-Rs0.00</span><button class="delete-btn">x</button>

            </li>
        </ul>
        <h3>Add new transaction</h3>
        <form id="form">
            <div class="form-control">
                <label form="text">Text</label>
                <input type="text" id="text" placeholder="Enter Text...">

            </div>
            <div class="form-control">
                <label form="amount">Amount</label>
                <input type="number" id="amount" placeholder="Enter Amount...">

            </div>
<button class="btn">ADD TRANSACTIONS</button>
        </form>
        </div>
        <!--javascript file-->
        <script src="script.js"></script>
    </body>
</html>
