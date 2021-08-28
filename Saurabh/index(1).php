<?php include './admin/private/connection.php'; ?>
<?php
  if(isset($_POST['sendQuery'])) {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $query = $_POST['query'];

    $sql = "INSERT INTO `queries` (`name`, `mobile`, `email`, `query`) VALUES ('$name', '$mobile', '$email', '$query')";
    $res = mysqli_query($con, $sql);
    if($res)
      echo "<script> alert('Your Query submitted sucessfully. Our executive will contact you soon.'); </script>";
    else
      echo "<script> alert('Sorry for your inconvenience. Oops. Something went wrong.'); </script>";
  }
?>

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


        <div class="enquiry-slide">
          <div class="enquiry-content">
            <form action="" method="post">
              <div class="row" id="enquiry-container">
                <h5>Enquiry</h5>
                <div class="col-xs-6 col-md-4">
                  <input type="text" name="name" id="" class="form-control transparent-input mt-2" placeholder="Enter Name" required>
                </div>
                <div class="col-xs-6 col-md-4">
                  <input type="number" name="mobile" id="" class="form-control transparent-input mt-2" placeholder="Enter Mobile Number" required>
                </div>
                <div class="col-md-4">
                  <input type="email" name="email" id="" class="form-control transparent-input mt-2" placeholder="Enter e-mail address" required>
                </div>
                <div class="col-sm-12">
                  <textarea name="query" rows="5" id="" class="form-control transparent-textarea mt-2 mb-2" placeholder="Enter Query" required></textarea>
                </div>
                <div class="col-sm-12 text-center">
                  <input type="submit" name="sendQuery" value="Send" class="btn btn-primary">
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
      
    </div>

    <?php 
      $sqlHiddenCat = "SELECT * FROM `blog_categories` WHERE `display` = 0";
      $resHiddenCat = mysqli_query($con, $sqlHiddenCat);

      $query = "";
      $iteration = 0;
      if(mysqli_num_rows($resHiddenCat) > 0) {
        while($recHiddenCat = mysqli_fetch_assoc($resHiddenCat)) {
          $id = $recHiddenCat['id'];
          if($iteration < 1) {
            $query = $query."`blog_category` != ".$id." ";
            $iteration++;
          }
          else {
            $query = $query."and `blog_category` != ".$id." ";
            $iteration++;
          }
        }
      }

      echo $query;
    ?>


    <?php
      if($query == "")
        $sqlFetchFeatured = "SELECT * FROM `blogs`  WHERE `featured` = 1 ORDER BY `id` DESC";
      else 
        $sqlFetchFeatured = "SELECT * FROM `blogs`  WHERE `featured` = 1 and ".$query." ORDER BY `id` DESC";
      $resFetchFeatured = mysqli_query($con, $sqlFetchFeatured);
      if(mysqli_num_rows($resFetchFeatured) > 0) {
    ?>
        <div class="mb-5">
          <div class="row">
            <div class="col-md-12">
              <div id="news-slider" class="owl-carousel">
    <?php
              while($recFetchFeatured = mysqli_fetch_assoc($resFetchFeatured)) {
                $id = $recFetchFeatured['id'];
                $blog_title = $recFetchFeatured['blog_title'];
                $description = $recFetchFeatured['description'];
                $image_url = $recFetchFeatured['image_url'];
                $updatedAt = $recFetchFeatured['updatedAt'];
    ?>
                <div class="post-slide">
                  <div class="post-img">
                    <img src="./assets/images/<?php echo$image_url; ?>" alt="">
                    <a href="blog-detail.php?blog=<?php echo $id; ?>" class="over-layer"><i class="fa fa-link"></i></a>
                  </div>
                  <div class="post-content">
                    <h3 class="post-title">
                      <a href="#"><?php echo$blog_title; ?></a>
                    </h3>
                    <div class="fixed-height">
                      <p class="post-description"> <?php echo $description; ?> </p>
                    </div>
                    <span class="post-date"><i class="fa fa-clock-o"></i><?php echo $updatedAt; ?></span>
                    <a href="blog-detail.php?blog=<?php echo $id; ?>" class="read-more undecorated-links">read more</a>
                  </div>
                </div>
    <?php
        }
    ?>
              </div>
            </div>
          </div>
        </div>
    <?php
      }
    ?>
    
    <div class="row mt-5 mb-5">
      <div class="col-md-8">
        <?php
          if($query == "")
            $sqlFetchNonFeatured = "SELECT * FROM `blogs` WHERE `featured` = 0 ORDER BY `id` DESC";
          else
            $sqlFetchNonFeatured = "SELECT * FROM `blogs` WHERE `featured` = 0 and ".$query."ORDER BY `id` DESC";

          $resFetchNonFeatured = mysqli_query($con, $sqlFetchNonFeatured);
          if(mysqli_num_rows($resFetchNonFeatured) > 0) {
            while($recFetchNonFeatured = mysqli_fetch_assoc($resFetchNonFeatured)) {
              $id = $recFetchNonFeatured['id'];
              $blog_title = $recFetchNonFeatured['blog_title'];
              $description = $recFetchNonFeatured['description'];
              $image_url = $recFetchNonFeatured['image_url'];
        ?>
                <div class="container-fluid mt-4 home-blogs p-3">
                  <img src="./assets/images/<?php echo $image_url; ?>" class="home-blog-image" alt="">
                  <div>
                    <h5 class="text-uppercase"><?php echo $blog_title; ?></h5>
                    <div class="fixed-height">
                      <p class="text-secondary"> <?php echo $description; ?> </p>
                    </div>
                    <a href="blog-detail.php?blog=<?php echo $id; ?>" class="btn btn-lg btn-secondary mt-2">Read more &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> </a>
                  </div>
                </div>
                
        <?php
            }
          }
        ?>
      </div>
      <div class="col-md-4">
        <div class="container-fluid mt-4">
          <div class="card p-3 categories-card">
            <h5 class="text-secondary text-center">Categories</h5>
            <?php
              $sqlFetchCategories = "SELECT * FROM `blog_categories` WHERE `display` = 1";
              $resFetchCategories = mysqli_query($con, $sqlFetchCategories);
              if(mysqli_num_rows($resFetchCategories)) {
                while($recFetchCategories = mysqli_fetch_assoc($resFetchCategories)) {
                  $id = $recFetchCategories['id'];
                  $category = $recFetchCategories['category'];
            ?>
                  <div class="btn btn-md btn-white btn-block mt-2"> 
                    <a href="category.php?cat=<?php echo$id; ?>" class="undecorated-links text-secondary"> <?php echo $category; ?> </a>
                  </div>
            <?php
                }
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php' ?>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js">
   </script>
  
  <script> 
    $(document).ready(function() {
        $("#news-slider").owlCarousel({
            items : 3,
            itemsDesktop:[1199,3],
            itemsDesktopSmall:[980,2],
            itemsMobile : [600,1],
            navigation:true,
            navigationText:["",""],
            pagination:true,
            autoPlay:true
        });
    });
  </script>  
</body>
</html>