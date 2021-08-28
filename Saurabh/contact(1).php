<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saurabh Upreti Blogs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="./assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <?php include 'navigation.php'; ?>
  
  <div class="container">
    <div id="header">
      <img src="https://cdn.pixabay.com/photo/2017/05/19/06/22/desktop-2325627_960_720.jpg" class="img-fluid" id="home-image" alt="...">
      <div class="overlay">
        <h1>Contact Us</h1>
      </div>
    </div>

    <div class="text-center mt-5">
      <div class="enquiry-slide">
        <div class="enquiry-content">
          <form action="contact.php" method="post">
            <div class="row" id="enquiry-container">
              <div class="col-xs-6 col-md-4">
                <input type="text" name="name" id="" class="form-control mt-2" placeholder="Enter Name" required>
              </div>
              <div class="col-xs-6 col-md-4">
                <input type="number" name="mobile" id="" class="form-control mt-2" placeholder="Enter Mobile Number" required>
              </div>
              <div class="col-md-4">
                <input type="email" name="email" id="" class="form-control mt-2" placeholder="Enter e-mail address" required>
              </div>
              <div class="col-sm-12">
                <textarea name="query" rows="10" id="" class="form-control mt-2 mb-2" placeholder="Enter Query" required></textarea>
                <input type="submit" value="Send" name="contact_submit" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row mt-5 text-sm-center">
      <div class="col-md-4">
        <span class="h6">
          <i class="fa fa-whatsapp me-2 text-success" aria-hidden="true"></i><br/>
          +91-1234567890
        </span>
      </div>
      <div class="col-md-4">
      <span class="h6">
          <i class="fa fa-envelope-o me-2 text-danger" aria-hidden="true"></i><br/>
          saurabhupreti@gmail.com
        </span>
      </div>
      <div class="col-md-4">
        <span class="h6">
          <i class="fa fa-facebook me-2 text-primary" aria-hidden="true"></i><br/>
          saurabhupreti
        </span>
      </div>
    </div>
  </div>

  <?php
    include './admin/private/connection.php';
    if(isset($_POST['contact_submit'])) {
      $name = $_POST['name'];
      $mobile = $_POST['mobile'];
      $email = $_POST['email'];
      $query = $_POST['query'];

      $sql = "INSERT INTO `queries` (`name`, `mobile`, `email`, `query`) VALUES ('$name', '$mobile', '$email', '$query')";
      $res = mysqli_query($con, $sql);
      if($res) {
        echo "<script> alert('Your Query submitted sucessfully. Our executive will contact you soon.'); </script>";
        echo "<script> window.open('contact.php', '_self'); </script>";
      }
      else
        echo "<script> alert('Sorry for your inconvenience. Oops. Something went wrong.'); </script>";
    }
  ?>
  <?php include 'footer.php' ?>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>