<?php
$connect = new PDO("mysql:host=localhost;dbname=infoweb", "root", "");
if(isset($_POST["send"])){
  
  }
    if(isset($_POST['send'])){
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $password_1 = $_POST['password'];
      $password = password_hash($password_1, PASSWORD_DEFAULT);
      if(!empty($email) && !empty($password)) { 
        // Check the email with database 
        $stm = $connect->prepare("SELECT user_email 
        FROM `usersinfo` WHERE `user_email`= :user_email LIMIT 1"); 
        $stm->bindParam(':user_email', $email);
        //$stm->bindParam(':user_password', $password);
        $stm->execute(); 
        $resultOfCheckUser = $stm->fetchAll();
        if(empty($resultOfCheckUser)){
          if(empty($_POST['terms'])){
            $result = "Must Check the terms";
          }else{
              $sql = $connect->prepare("insert into usersinfo(
              user_first_name,
              user_last_name,
              user_email,
              user_password
              )
              values (
                '$fname',
                '$lname',
                '$email',
                '$password'
              )");
                $sql->execute();
              // header('location: signup.php');
          }
        }
        else {
          $loginCheck = "user exists try to login";
        }
      } 
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <link rel="stylesheet" href="../css/signup.css">
  <style>
    

  </style>
  <title>signup</title>
</head>
<body>
  <div class="container">
    <div class="background">
    <div class="user-info">
      <div class="signup active-user">
        sign up</div>
      <div class="signin">sign in</div>
    </div>
    <br>
    <form action="" method="POST">
      <input class="specail" type="text" name="fname" placeholder="first name" required><br>
      <input class="specail" type="text" name="lname" placeholder="last name" required><br>
      <input class="specail" type="email" name="email" placeholder="email" required><br>
      <input class="specail" type="password" name="password" placeholder="password" required><br>
      <input id="input" type="checkbox" name="terms"><label for="input">accept</label> <span>terms & conditions</span>
      <?php if(!empty($result)) echo "<div class='check'>$result</div>";
            if(!empty($loginCheck)) echo "<div class='check'>$loginCheck</div>" ?>
      <input type="submit" value="sign up" name="send">
    </form>
    </div>
  </div>
  <script src="../js/signup.js"></script>
</body>
</html>