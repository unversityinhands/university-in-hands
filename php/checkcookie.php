<?php

$con = new PDO("mysql:host=localhost; dbname=infoweb", "root", "");
session_start();
if (isset($_COOKIE['remember_token'])) {
  $cookie_token = $_COOKIE['remember_token'];
  $expiration = time();
  $formatted_expiration = date('Y-m-d', $expiration);

  // Look up the token in the database
  $query = "SELECT user_id FROM remember_me_tokens WHERE token = '$cookie_token' AND expiration > '$formatted_expiration'";
  $stmt = $con->query($query);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (isset($user['user_id'])) {
    $_SESSION['user_id'] = $user['user_id'];
    $manager_id = $user['user_id'];
    $sql = $con->prepare("SELECT manager_id from unversity_info where manager_id = '$manager_id'");
    $sql->execute();
    if ($sql->rowCount() > 0) {
      $_SESSION['admin'] = $user;
    }
  }
}
