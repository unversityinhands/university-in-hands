<?php


$con = new PDO('mysql:host=localhost;dbname=infoweb', 'root', '');

if(isset($_POST['send'])){
  $instructorName = $_POST['instructor-name'];
  $instructorExpr = $_POST['instructor-expr'];
  $unverName = $_POST['unver-name'];
  $unverDescription = $_POST['unver-description'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $arr = [];
  
  

  if(empty($instructorName) ||  empty($instructorExpr) || 
  empty($unverName) || empty($email )||
  empty($unverDescription)|| empty($password)){
    $fieldsFill = "Must Fill All the Fields";
  }else if($_FILES['logo']['error'] === 4){
    echo "<script>alert('image doest not exists');</script>";
  }
  else {
    $fileName = $_FILES['logo']['name'];
    $fileSize = $_FILES['logo']['size'];
    $tmpName = $_FILES['logo']['tmp_name'];
    $newImageName = NULL;

    $validImageExtention = ['jpg', 'jpeg', 'png'];
    $imageExtention = explode('.', $fileName);
    $imageExtention = strtolower(end($imageExtention));
    if(!in_array($imageExtention, $validImageExtention)){
      echo "<script>alert('Invalid image extention');</script>";
    }else if ($fileSize > 1000000){
      echo "<script>alert('image size is to large');</script>";
    }
    else {
      $newImageName = uniqid();
      $newImageName .= '.'. $imageExtention;

      move_uploaded_file($tmpName, '../logos/' . $newImageName);
    }
    $insert = $con->prepare("insert into instructor_info(instructor_name, instructor_expr, unversity_id, email, password) 
    values('$instructorName', '$instructorExpr', 'null', '$email', '$password' ); ");
  $insert->execute();
  $sql = $con->query("select * from instructor_info order by instrutor_id desc limit 1; ");
  $row = $sql->fetchColumn(0);
    // $major_select_for_insertion = $con->query('select * from majors_info where major_name = ');
    $sql = $con->prepare("insert into unversity_info(unversity_name, description, logo,manager_id) 
    values(:unverName, :unverDescription, :newImageName, :manager_id);");
    $sql->execute(
      array(
        ':unverName' => $unverName,
        ':unverDescription' => $unverDescription,
        ':newImageName' => $newImageName,
        ':manager_id' => $row
      )
    );
    $unversity = $con->query("select * from unversity_info 
    order by unversity_id desc limit 1");
    $unversity_info = $unversity->fetchColumn(0);
    foreach($_POST['checkbox'] as $check){
      $sql = $con->query("select * from majors_info 
        where major_name = '$check'; ");
      $row = $sql->fetchColumn(0);

      $insert = $con->prepare("insert into unversity_majors values($unversity_info, $row ); ");
      $insert->execute();

      $update = $con->prepare("update instructor_info set unveristy_id = $unversity_info where manager_id =  ");
      $update->execute();
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
        <label for="">instructor name: </label>
        <input class="specail" type="text" name="instructor-name"> <br>
        <label for="">instructor experience: </label>
        <textarea class="" name="instructor-expr" id="" cols="30" rows="10"></textarea>
        <label for="">unveristy name: </label>
        <input class="specail" type="text" name="unver-name"> <br>
        <label for="">unveristy description: </label>
        <textarea name="unver-description" id="" cols="30" rows="10"></textarea>


        <label for="">major name: </label><br>
        <?php
            $major_select = $con->query('select * from majors_info');
            while($row = $major_select->fetchColumn(1))
            {
          ?> 
              <input type="checkbox" name="checkbox[]" value="<?php echo $row; ?>">
              <label for=""><?php echo $row; ?></label><br>
              
            <?php } ?>
        <br>
              <label for="">Logo</label>
              <input type="file" name="logo"><br>

        <label for="">email: </label><br>
        <input class="specail" type="emial" name="email"> <br>
        <label for="">password: </label><br>
        <input class="specail" type="emial" name="password"> <br>
        <div class="fill-field"><?php if(isset($fieldsFill)) echo $fieldsFill; ?></div>
        <input class="specail" type="submit" value="send" name="send">
      </form>
    </div>
  </div>
</body>
</html>