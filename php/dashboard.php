<?php
session_start();
$connect = new PDO("mysql:host=localhost;dbname=infoweb", "root", "");
if (!empty($_SESSION['admin'])) {
  $user_id = $_SESSION['user_id'];
  $query = "select * from unversity_info where manager_id = '$user_id'";
  $row = $connect->query($query);
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
      margin: 0;
      padding: 0;
    }

    body {
      background-image: url("../images/back1.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      /*rgb(233, 231, 231)*/
      font-family: Arial, Helvetica, sans-serif;
    }

    .container {
      position: fixed;
      left: -200px;
      top: 0;
      background-color: #ccc;
      width: 200px;
      z-index: 1000;
      min-height: 100vh;
      transition: 0.3s;
    }

    .container .close {
      right: -25px;
      top: 10px;
      background-color: black;
      width: 25px;
      height: 25px;
      position: absolute;
    }

    .open {
      left: 0;
    }

    .container .panel {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      position: absolute;
    }

    .container .panel ul li {
      border-bottom: 1px black solid;
      padding: 15px 10px;
      list-style: none;
    }

    .container .panel ul li a {
      color: black;
      text-decoration: none;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }

    table tr td {
      max-width: 120px;
      /* white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis; */
      word-wrap: break-word;
      height: 50px;
    }

    table tr th {
      max-width: 120px;
      /* white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis; */
      height: 50px;
      word-wrap: break-word;
    }

    table tr td img {
      max-width: 100%;
    }
  </style>
</head>

<body>
  <table>
    <tr>
      <th>unveristy name</th>
      <th>unveristy description</th>
      <th>logo</th>
    </tr>
    <?php while ($sel = $row->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $sel['unversity_name'] ?></td>
        <td><?php echo $sel['description'] ?></td>
        <td><img src="../logos/<?php echo $sel['logo'] ?> ?>" alt=""></td>
      </tr>
    <?php } ?>
  </table>
</body>

</html>