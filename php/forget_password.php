<?php


if (isset($_POST['send'])) {
  $con = new PDO('mysql:host=localhost;dbname=infoweb', 'root', '');
  $email = $_POST['email'];
  $sql = $con->query("select user_email from usersinfo where user_email = '$email'");
  $row = $sql->fetch(PDO::FETCH_ASSOC);
  if (!empty($row)) {
    header('location: forget_vertify.php');
  } else {
    $Error = '<div class="user-val">user not found</div>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/signin.css">
  <title>Document</title>
</head>

<body>
  <div class="container">
    <form action="" method="post">
      <input type="email" class="specail" placeholder="emial" name="email">
      <input type="submit" value="send" name="send">
      <?php if (isset($Error)) echo $Error; ?>
    </form>
  </div>
</body>

</html>