<?php


$connect = new PDO("mysql:host=localhost;dbname=infoweb", "root", "");


// Save user email to variable; 
session_start();
if (isset($_POST['send'])) {
  $user_email = ($_POST['email']) ? trim($_POST['email']) : "";
  $user_password = $_POST['password'];
  // Check if $user_email is not empty.
  if (!empty($user_email) && !empty($user_password)) {
    // Check the email with database 
    $stm = $connect->query("SELECT user_password,user_id FROM `usersinfo` 
    WHERE `user_email` = '$user_email' LIMIT 1");
    $hash_passowrd = $stm->fetch(PDO::FETCH_ASSOC);
    if (password_verify($user_password, $hash_passowrd['user_password'])) {
      $result = 1;
      // check if user has unversity 

      $_SESSION['user_id'] = $hash_passowrd['user_id'];
      if (!empty($_POST["remember_me"])) {
        $token = bin2hex(random_bytes(32));
        $expiration = time() + (30 * 24 * 60 * 60);

        $formatted_expiration = date('Y-m-d', $expiration);
        $user_id = $_SESSION['user_id'];

        // Store the token and expiration in the database for the user
        // (You'll need to adapt this part based on your database structure)
        $sql = $connect->prepare("SELECT user_id from remember_me_tokens where user_id = '$user_id';");
        $sql->execute();
        if ($sql->rowCount() > 0) {
          echo "have Token";
        } else {
          $cookie_name = 'remember_token';
          $cookie_value = $token;
          $cookie_expiration = $formatted_expiration;
          $cookie_path = '/';
          setcookie($cookie_name, $cookie_value, $expiration, $cookie_path);
          $query = "INSERT INTO remember_me_tokens (user_id, token, expiration) 
          VALUES ('$user_id', '$token', '$formatted_expiration')";
          $stmt = $connect->prepare($query);
          $stmt->execute();
        }
      }
    }
  } else {
    $result = 100;
  }
  // $result = $stm->fetchColumn(); 
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/signin.css">
  <title>signin</title>
</head>

<body>
  <div class="container">
    <div class="user-info">
      <div class="signup">
        sign up</div>
      <div class="signin active-user">sign in</div>
    </div>
    <br>
    <form action="" method="POST">
      <input class="specail" type="email" name="email" placeholder="email" required><br>
      <input class="specail" type="password" name="password" placeholder="password" required><br>
      <div class="forget-pass">Forget Password?</div>
      <input id="remember" type="checkbox" name="remember_me"><label for="remember" class="rem-me">Remember Me</label>
      <?php
      if (isset($result)) {
        if ($result == 1) {

          header("location: ../index.php");
        } else {
          echo "<br><div class='user-val'>email or password wrong</div>";
        }
      }
      ?>
      <input type="submit" value="sign in" name="send">
    </form>
    <div class="not-user">Don't have an account? <span>sign up</span></div>
  </div>
  <script src="../js/signin.js"></script>
</body>

</html>