<?php
include("config.php");
if (isset($_POST['input'])) {

  $input = $_POST['input'];

  $query = "SELECT * FROM unversity_info where unversity_name like '{$input}%'";

  $result = $con->query($query);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <style>
    table tr td {
      width: 200px;
      text-align: center;
    }

    table tr td.spcial {
      padding: 80px;
    }

    table tr td.spcial div {
      padding: 25px 0px;
      background-color: #3f51b5;
      border-radius: 10px;
      color: white;
    }

    table tr td img {
      max-width: 100%;
    }
  </style>
</head>

<body>

  <?php if ($result->rowCount() > 0) { ?>
    <table class="table table-bordered table-striped mt-4">
      <tr>
        <th>unversity name</th>
        <th>unversity description</th>
        <th>logo</th>
      </tr>

      <?php
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $unvName = $row['unversity_name'];
        $unvDes = $row['description'];
        $unvLogo = $row['logo'];
      ?>
        <tr>
          <td><?php echo $unvName ?></td>
          <td><?php echo $unvDes ?></td>
          <td><img class="img-fluid" src="<?php echo "../logos/" . $unvLogo ?>" alt=""></td>
          <td class="spcial">
            <div>Join</div>
          </td>
        </tr>
      <?php } ?>

    </table>
  <?php
  } else {
    echo "<h6>No data Found</h6>";
  } ?>
</body>

</html>