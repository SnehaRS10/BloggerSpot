<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account <a href = 'signup.php'> Sign Up here!</p>
    </div>
   
    <?php
     
      require_once('database.php');
      session_start();
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $entered_username = $_POST['username'];
          $entered_password = $_POST['password'];
      
          $sql = "SELECT * FROM `signup` WHERE `username`= '$entered_username'";
          $result = $con->query($sql);
      
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $hashed_password = $row['password'];
      
              if (password_verify($entered_password, $hashed_password)) {
                  echo "Login Successfully";
                  session_start();
      
                  // Set the user_id in the session
                  $_SESSION['user_id'] = $row['user_id'];
      
                  // Redirect to main.php
                  header("Location: main.php");
                  exit();
              } else {
                  echo "Please Check Your Password!";
              }
          } else {
              echo "Please Sign Up";
          }
      }
      
      $con->close();
      ?>
</body>
</html>
