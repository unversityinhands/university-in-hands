<?php
require('php/checkcookie.php');
$con = new PDO('mysql:host=localhost; dbname=infoweb', 'root', '');
$result = false;
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = $con->prepare("SELECT manager_id 
            from unversity_info where manager_id = '$user_id'");
  $sql->execute();
  if ($sql->rowCount() > 0) {
    $result = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Awesome library -->
  <link rel="stylesheet" href="css/all.min.css">
  <!-- Normalize -->
  <link rel="stylesheet" href="css/normalize.css">
  <!-- main CSS file -->
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <div class="header-1">
    <div class="choices">
      <div class="after-ps"></div>
      <ul class="parent-ul">
        <li class="university add-border">
          <p class="unv-border remove-border">unversities</p>
          <ul class="child-ul">
            <li><a href="php/creation_from_GPT.php">create unversity</a></li>
            <li><a href="php/joinToUnversity.php">join to unversity</a></li>
            <li><a href="#">Be Instructor</a></li>
            <?php
            if ($result === true) {
            ?>
              <li><a href="php/dashboard.php">dashboard</a></li>
            <?php
              $_SESSION['admin'] = $user_id;
            }

            ?>
          </ul>
        </li>
        <li><a href="#">home</a></li>
        <li><a href="">about us</a></li>
      </ul>
    </div>
    <div class="container">
      <div class="start-land">
        <div class="logo">
          <img src="images/logo (1).png" alt="">
        </div>
        <?php if (empty($_SESSION['user_id'])) { ?>
          <a href="php/signin.php" class="signin specail-raduis">sign in</a>
        <?php } else { ?>
          <a href="#" class="signin specail-raduis">profile</a>
        <?php } ?>
      </div>
    </div>
  </div>

  <div class="landing">
    <div class="container">
      <div class="description">
        <h3>The <span>Wise</span> Selection for the <span>Future</span></h3>
        <p>Welcome to our website that's provides online unversities
          provide a comprehensive resource for individuals seeking to expand their knowledge and skills through the convenience and flexibility of online education.</p>
      </div>
      <div class="img-1">
        <img src="images/5518573.jpg" alt="">
      </div>
    </div>
  </div>

  <div class="box-parent">
    <div class="container">
      <div class="con-items">
        <div class="image"><img src="images/study_14126061.png" alt=""></div>
        <div class="con-text">
          <h5>Ease of access</h5>
          <p>Lorem ips molestiae Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla beatae voluptat</p>
        </div>
      </div>
      <div class="con-items">
        <div class="image"><img src="images/study_14126061.png" alt=""></div>
        <div class="con-text">
          <h5>Ease of access</h5>
          <p>Lorem ips molestiae Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla beatae voluptat</p>
        </div>
      </div>
      <div class="con-items">
        <div class="image"><img src="images/study_14126061.png" alt=""></div>
        <div class="con-text">
          <h5>Ease of access</h5>
          <p>Lorem ipsum dolor modi officia voluptatum eius sunt labore accusantium corporoluptatibus.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="unversity-top">
    <div class="container">

    </div>
  </div>
  <script src="js/index.js"></script>
</body>

</html>