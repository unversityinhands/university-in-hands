<?php

$con = new PDO("mysql:host=localhost; dbname=infoweb", "root", "");

$sql = "select * from unversity_info like";


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="../jquery/jquery-3.2.1.min.js"></script>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <style>
    .con {
      height: 150px;
      text-align: center;
    }

    .con div {
      margin-top: 30px;
      font-size: 40px;
      font-weight: bold;
    }

    form {
      margin-top: 50px;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="con">
    <div>Search For Universities</div>
    <form action="" method="post">
      <input type="text" id="live_search" placeholder="search">
    </form>
  </div>
  <div id="unversities"></div>
  <script>
    $(document).ready(function() {

      $("#live_search").keyup(function() {
        var input = $(this).val();
        if (input !== '') {
          $.ajax({
            url: "liveseach.php",
            method: "POST",
            data: {
              input: input
            },

            success: function(data) {
              $("#unversities").css('display', 'block');
              $("#unversities").html(data);
            }
          });
        } else {
          $("#unversities").css('display', 'none');
        }
      })

    });
  </script>
</body>

</html>