<?php session_start(); ?>

<?php require './private/connection.php'; ?>
<?php
  if(isset($_POST['login'])){
    $admin_email = $_POST['admin_email'];
    $password = $_POST['admin_pass'];

    $sql = "SELECT * FROM `admin` WHERE `email` = '$admin_email'";
    $res = mysqli_query($con, $sql);
    if($info = mysqli_fetch_assoc($res)){
      if(password_verify($password, $info['password'])){
        $admin_name = $info['username'];
        $_SESSION['admin_name'] = $admin_name;
        $_SESSION['admin_email'] = $admin_email;
        echo "<script>window.open('index.php','_self')</script>";  
      } else{
        echo '<script>alert("Invalid Id or Password");</script>';
      }
    } else{
      echo '<script>alert("Invalid Id or Password");</script>';
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saurabh Upreti Blog Admin Add Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" />
  <link href="./assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>


  <div class="outer">
    <div class="middle">
      <div class="inner">
        <h3 class="text-center text-primary">Sign Up</h3>
        <form action="" method="post">
          <input class="form-control" type="email" name="admin_email" id="" placeholder="Enter e-mail" required>
          <input class="form-control mt-2" type="password" name="admin_pass" id="" placeholder="Enter Password" required>
          <input type="submit" name="login" class="btn btn-primary form-control mt-2" value="Log in">
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>