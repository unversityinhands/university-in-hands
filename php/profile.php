<?php
session_start();
$user_id = $_SESSION['user_id'];
$con = new PDO('mysql:host=localhost; dbname=infoweb', 'root', '');
$sql = $con->query("SELECT user_first_name, user_last_name, user_email FROM usersinfo where user_id = $user_id");
$row = $sql->fetch(PDO::FETCH_ASSOC);


if (isset($_POST["logout"])) {

  $cookie_token = $_COOKIE['remember_token'];
  // Clear the remember me cookie
  setcookie('remember_token', '', time() - 3600, '/');


  // Delete the token from the database
  $query = "DELETE FROM remember_me_tokens WHERE token ='$cookie_token'";
  $stmt = $con->prepare($query);
  $stmt->execute();

  header("location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      --moz-box-sizing: border-box;
      --webkit-box-sizing: border-box;
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }

    :root {
      --main-color: #125c71;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      background-image: url('../images/back1.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
    }

    ul {
      list-style: none;
    }

    .container {
      padding-left: 15px;
      padding-right: 15px;
      margin-left: auto;
      margin-right: auto;
      min-height: 97px;
    }

    /* Small */
    @media (min-width: 768px) {
      .container {
        width: 750px;
      }
    }

    /* Medium */
    @media (min-width: 992px) {
      .container {
        width: 970px;
      }
    }

    /* Large */
    @media (min-width: 1200px) {
      .container {
        width: 1170px;
      }
    }

    /* Start Components */
    .main-heading {
      text-align: center;
    }

    .main-heading h2 {
      font-weight: normal;
      font-size: 400;
      position: relative;
      margin-bottom: 70px;
      text-transform: uppercase;
    }

    .main-heading h2::before {
      content: '';
      position: absolute;
      left: 50%;
      transform: translatex(-50%);
      height: 2px;
      background-color: #333;
      bottom: -30px;
      width: 120px;
    }

    .main-heading h2::after {
      content: '';
      position: absolute;
      left: 50%;
      transform: translatex(-50%);
      height: 14px;
      width: 14px;
      bottom: -38px;
      border-radius: 50%;
      border: 2px solid #333;
      background-color: white;
    }

    .main-heading p {
      width: 550px;
      margin: 0 auto 100px;
      max-width: 100%;
      line-height: 2;
      color: #777;
    }

    /* End Components */
    /* Start Header */
    header {
      position: absolute;
      left: 0;
      width: 100%;
      z-index: 2;
      background-color: var(--main-color);
    }

    header .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
    }

    header .container::after {
      content: '';
      position: absolute;
      height: 1px;
      background-color: #a2a2a2;
      bottom: 0;
      width: calc(100% - 30px);
      left: 15px;
    }

    header .logo img {
      height: 40px;
    }

    header nav {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }

    header nav .toggle-menu {
      color: white;
      font-size: 22px;
    }

    @media (min-width: 768px) {
      header nav .toggle-menu {
        display: none;
      }
    }

    header nav ul {
      display: flex;
    }

    @media (max-width: 767px) {
      header nav ul {
        display: none;
      }

      header nav ul li a {
        padding: 15px !important;
        text-align: center;
        z-index: 2;
        background-color: #000000;
      }
    }

    header nav .toggle-menu:hover+ul {
      display: flex;
      flex-direction: column;
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background-color: rgb(0, 0, 0 / 50%);
    }

    header nav ul li a {
      display: block;
      color: white;
      text-decoration: none;
      font-size: 14px;
      transition: 0.3s;
      padding: 40px 10px;
      position: relative;
      z-index: 2;

    }

    header nav ul li a.active,
    header nav ul li a:hover {
      color: black;
      border-bottom: 1px solid var(--main-color);
    }

    header nav .form {
      width: 40px;
      height: 30px;
      position: relative;
      margin-left: 30px;
      border-left: 1px solid white;
    }

    header nav .form i {
      color: white;
      position: absolute;
      font-size: 20px;
      top: 50%;
      transform: translatey(-50%);
      right: 0;
    }

    /* End Header */
    .profile {
      padding-top: 120px;
    }

    .profile .container {
      display: flex;
      justify-content: space-around;
      background-color: var(--main-color);
      padding: 40px;
      border-radius: 20px;
    }

    .profile .container .image {
      width: 300px;
    }

    .profile .container .image img {
      width: 100%;
      border-radius: 20px;
    }

    .profile .container ul li {
      padding: 5px;
      color: #e8e8e8;
    }
  </style>
</head>

<body>
  <!-- Start Header -->
  <header>
    <div class="container">
      <a href="#" class="logo">
        <img src="../images/logo2.png" alt="Logo" />
      </a>
      <nav>
        <i class="fas fa-bars toggle-menu"></i>
        <ul>
          <li><a href="../index.php" class="active">Home</a></li>
          <li><a href="../index.php">Services</a></li>
          <li><a href="../index.php">Portfolio</a></li>
          <li><a href="../index.php">About</a></li>
          <li><a href="../index.php">Pricing</a></li>
          <li><a href="../index.php">Contact</a></li>
          <?php

          if ($_SESSION['admin']) { ?>
            <li><a href="php/dashboard.php">dashboard</a></li>
          <?php }
          ?>
          <li><a href="#">Profile</a></li>
        </ul>
        <div class="form">
          <i class="fas fa-search" id="icon"></i>
        </div>
      </nav>
    </div>
  </header>
  <!-- End Header -->
  <div class="profile">
    <div class="container">
      <div class="image">
        <img src="../logos/<?php echo $row['user_img'] ?>" alt="">
      </div>
      <ul>
        <li>first name:<?php echo $row['user_first_name'] ?></li>
        <li>last name:<?php echo $row['user_last_name'] ?></li>
        <li>email:<?php echo $row['email'] ?></li>
        <form action="" method="post">
          <input type="submit" value="logout" name="logout">
        </form>
      </ul>
    </div>
  </div>
</body>

</html>