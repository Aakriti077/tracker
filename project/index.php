<?php
session_start(); // Start the session

// Check if the user is logged in and if their name is set in the session
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';

//logout
if(isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit;
}

//for income
// Include your database connection code
include 'db.php';

// Example SQL query to fetch total income amount
$sql = "SELECT SUM(amount) AS total_income FROM income";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_income = $row['total_income'];
} else {
    $total_income = 0;
}

// Close database connection
mysqli_close($conn);

//for expense
// Include your database connection code
include 'db.php';

// Example SQL query to fetch total income amount
$sql = "SELECT SUM(amount) AS total_expense FROM expense";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_expense = $row['total_expense'];
} else {
    $total_expense = 0;
}

// Close database connection
mysqli_close($conn);

//for total
// Include your database connection code
include 'db.php';

// Initialize total amount
$total_amount = 0;

// Example SQL query to fetch total income amount
$sql = "SELECT SUM(amount) AS total_income FROM income";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_income = $row['total_income'];
    $total_amount += $total_income; // Update total amount with income
}

// Example SQL query to fetch total expense amount
$sql = "SELECT SUM(amount) AS total_expense FROM expense";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $total_expense = $row['total_expense'];
    $total_amount -= $total_expense; // Update total amount with expense
}

// Close database connection
mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/style.css" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
  </head>
  <body>
    <div class="container">
      <aside>
        <div class="top">
          <div class="logo">
            <!-- <img src="./imgs/bg.jpg" alt="logo" /> -->
            <h2>Expense<span class="danger">Tracker</span></h2>
          </div>
          <div class="close" id="close-btn">
            <span class="material-symbols-sharp"> close </span>
          </div>
        </div>

        <div class="sidebar">
          <a href="index2.php" class="active" onclick="showDashboard()">
            <span class="material-symbols-sharp"> grid_view </span>
            <h3>Dashboard</h3>
          </a>
          <a href="#"  onclick="loadIncome()">
            <span class="material-symbols-sharp"> payments </span>
            <h3>Income</h3>
          </a>
          <a href="#" onclick="loadExpenses()">
            <span class="material-symbols-sharp"> receipt_long </span>
            <h3>Expenses</h3>
          </a>
          <a href="#" >
            <span class="material-symbols-sharp"> trending_up </span>
            <h3>Transactions</h3>
          </a>
          <a href="#">
            <span class="material-symbols-sharp"> description </span>
            <h3>Reports</h3>
          </a>
          <a href="index2.php?logout=true" >
            <span class="material-symbols-sharp"> logout </span>
            <h3>Logout</h3>
          </a>
        </div>
      </aside>

      <main>
        <h1>Dashboard</h1>
         <div id="main-content"> 
          <div id="income-container"></div>
          <div id="expense-container"></div>
          <div id="dashboard-container"></div> 
        <!-- Income form will be loaded here -->
    </div>

        <div class="insights">
          
          <div class="total">
            <span class="material-symbols-sharp"> paid </span>
            <div class="middle">
              <div class="left">
                <h3>Total Amount</h3>
                <h1>$<?php echo $total_amount; ?></h1>
              </div>
            </div>
            <small class="text-muted"> Last total </small>
          </div>

          <!-- EXPENSES -->
          <div class="expenses">
            <span class="material-symbols-sharp"> receipt_long </span>
            <div class="middle">
              <div class="left">
                <h3>Total Expenses</h3>
                <h1>$<?php echo $total_expense; ?></h1>
              </div>
            </div>
            <small class="text-muted"> Last expenses </small>
          </div>

          <!-- INCOME -->
          <div class="income">
            <span class="material-symbols-sharp"> payments </span>
            <div class="middle">
              <div class="left">
                <h3>Total Income</h3>
                <h1>$<?php echo $total_income; ?></h1>
              </div>
            </div>
            <small class="text-muted"> Last income </small>
          </div>
        </div>

        <div class="box">
          <canvas id="pieChart"></canvas>
            <h1>Bar graphs here</h1>
        </div>
      </main>

      <div class="right" id="right" >
        <div class="top">
          <button id="menu-btn">
            <span class="material-symbols-sharp"> menu </span>
          </button>

          <div class="theme-toggler">
            <span class="material-symbols-sharp active"> light_mode </span>
            <span class="material-symbols-sharp"> dark_mode </span>
          </div>
          <div class="profile">
            <div class="info">
              <p>Hey, <?php echo $user_name; ?></p>
              <small class="text-muted">User</small>
            </div>

            <div class="profile-photo" id="profile-photo">
             <input type="file" id="profile-picture-input" accept="image/*" style="display: none;" />
             <!-- <label for="profile-picture-input"> -->
              <img src="../imgs/profile.png" alt="Profile Picture" id="profile-image" />
           <!-- </label> -->
           </div>

          </div>
        </div>

        <div class="recent-updates">
          <h2>Recent Updates</h2>
          <div class="updates">
            <div class="update">
                <div class="profile-photo">
                   <!-- <img src="./imgs/bg.jpg" alt="Profile Picture" />  -->
                </div>
                <div class="message">
                    <p> <b>Aakritee</b> so much bank balance</p>
                </div>
            </div>
            <div class="update">
                <div class="profile-photo">
                   <!-- <img src="./imgs/bg.jpg" alt="Profile Picture" />  -->
                </div>
                <div class="message">
                    <p> <b>Aakritee</b> has addred expenses</p>
                </div>
            </div>
            <div class="update">
                <div class="profile-photo">
                   <!-- <img src="./imgs/bg.jpg" alt="Profile Picture" />  -->
                </div>
                <div class="message">
                    <p> <b>Aakritee</b>lost her money</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

   <!-- <script src="./constants/recent-order-data.js"></script> -->
    <!-- <script src="./constants/update-data.js"></script> -->
    <!-- <script src="./constants/sales-analytics-data.js"></script> -->
    <script src="./js/index.js"></script> 
  <script src="./js/script.js"></script>

  </body>
</html>