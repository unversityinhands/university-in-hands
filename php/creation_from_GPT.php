<?php
// Establish a database connection
$dsn = "mysql:host=localhost;dbname=infoweb";
$username = "root";
$password = "";

try {
  $con = new PDO($dsn, $username, $password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}

session_start();
$user_id = $_SESSION['user_id'];
if (empty($user_id)) {
  echo "<script>alert('login first');
  window.location.href='signin.php'</script>";
}

if (isset($_POST['send'])) {
  $unverName = $_POST['unver_name'];
  $unverDescription = $_POST['unver_description'];
  $checkBox = $_POST['checkbox'];

  $user_id = $_SESSION['user_id'];
  $sql = $con->prepare("SELECT manager_id from unversity_info where manager_id = '$user_id'");
  $sql->execute();
  if ($sql->rowCount() > 0) {
    echo "<script> alert('You Already Created Unversity'); </script>";
  } else {
    if (empty($unverName) || empty($unverDescription)) {
      $fieldsFill = "Must Fill All the Fields";
    } else if ($_FILES['logo']['error'] === 4) {
      echo "<script>alert('image does not exist');</script>";
    } else {
      $fileName = $_FILES['logo']['name'];
      $fileSize = $_FILES['logo']['size'];
      $tmpName = $_FILES['logo']['tmp_name'];
      $newImageName = NULL;

      $validImageExtensions = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $fileName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtensions)) {
        echo "<script>alert('Invalid image extension');</script>";
      } else if ($fileSize > 1000000) {
        echo "<script>alert('Image size is too large');</script>";
      } else {
        $newImageName = uniqid() . '.' . $imageExtension;
        move_uploaded_file($tmpName, '../logos/' . $newImageName);
      }
      // Insert into unversity_info table
      $insertUniversity = $con->prepare("INSERT INTO unversity_info 
        (unversity_name, description, logo,manager_id) 
        VALUES (:unverName, :unverDescription, :newImageName,:manager_id)");
      $insertUniversity->execute(array(
        ':unverName' => $unverName,
        ':unverDescription' => $unverDescription,
        ':newImageName' => $newImageName,
        ':manager_id' => $user_id
      ));
      $universityId = $con->lastInsertId();


      foreach ($_POST['checkbox'] as $check) {
        $sql = $con->query("select * from majors_info 
                where major_name = '$check'; ");
        $row = $sql->fetchColumn(0);

        $insert = $con->prepare("insert into unversity_majors values($universityId, $row ); ");
        $insert->execute();
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/unversity-creation-style.css">
  <title>Document</title>
</head>

<body>

  <div class="unversity">
    <div class="container">
      <form action="" method="POST" autocomplete="off" enctype="multipart/form-data">
        <label for="">university name: </label>
        <input class="specail" type="text" name="unver_name"> <br>
        <label for="">university description: </label>
        <textarea name="unver_description" id="" cols="30" rows="10"></textarea>


        <label for="">major name: </label><br>
        <?php
        $majorSelect = $con->query('SELECT * FROM majors_info');
        while ($row = $majorSelect->fetchColumn(1)) {
        ?>
          <input type="checkbox" name="checkbox[]" value="<?php echo $row; ?>">
          <label for=""><?php echo $row; ?></label><br>

        <?php } ?>
        <br>
        <label for="">Logo</label>
        <input type="file" name="logo"><br>

        <div class="fill-field"><?php if (isset($fieldsFill)) echo $fieldsFill; ?></div>
        <input class="specail" type="submit" value="send" name="send">
      </form>
    </div>
  </div>
</body>

</html>