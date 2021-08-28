<?php session_start(); ?>
<?php
  if(!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email'])){
    header("Location: signin.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saurabh Upreti Blog Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" />
  <link href="./assets/css/custom.css" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'navigation.php'; ?>

  <?php 
    include './private/connection.php';
    $sql = "SELECT COUNT(`id`) FROM `blogs`";
    $res = mysqli_query($con, $sql);
    $number = mysqli_fetch_array($res);
    $blogs = $number[0];
    
    $sql = "SELECT COUNT(`id`) FROM `blogs` WHERE `featured` = '1'";
    $res = mysqli_query($con, $sql);
    $number = mysqli_fetch_array($res);
    $featured = $number[0];
    
    $sql = "SELECT COUNT(`id`) FROM `blog_categories` WHERE `display` = '1'";
    $res = mysqli_query($con, $sql);
    $number = mysqli_fetch_array($res);
    $categories = $number[0];

    $sql = "SELECT COUNT(`id`) FROM `queries`";
    $res = mysqli_query($con, $sql);
    $number = mysqli_fetch_array($res);
    $queries = $number[0];
  ?>

  <div class="container-fluid mt-5">
    <div class="row text-center">
      <div class="col-md-3 mt-2">
        <a class="text-primary undecorated-links h2" href="blogs.php"><i class="fab fa-blogger-b"></i> Blogs : <?php echo $blogs; ?> </a>
      </div>
      <div class="col-md-3 mt-2">
        <a class="text-warning undecorated-links h2" href="blogs.php"><i class="fas fa-star"></i> Featured : <?php echo $featured; ?> </a>
      </div>
      <div class="col-md-3 mt-2">
        <a class="text-success undecorated-links h2" href="blogs.php"><i class="fas fa-list"> </i> Categories : <?php echo $categories; ?> </a>
      </div>
      <div class="col-md-3 mt-2">
        <a class="text-secondary undecorated-links h2" href="queries.php"><i class="fas fa-question-circle"></i> Queries : <?php echo $queries; ?> </a>
      </div>
    </div>
  </div>

  <div class="container-fluid mt-5">
    <h2 class="text-primary text-center mt-5">Latest Posts</h2>
    <?php
      $sqlFetchFeatured = "SELECT * FROM `blogs`  WHERE 1 ORDER BY `id` DESC LIMIT 5";
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
                    <img src="../assets/images/<?php echo$image_url; ?>" alt="">
                    <a href="blog-detail.php?id=<?php echo $id; ?>" class="over-layer"><i class="fa fa-link"></i></a>
                  </div>
                  <div class="post-content">
                    <h3 class="post-title">
                      <a href="#"><?php echo$blog_title; ?></a>
                    </h3>
                    <div class="fixed-height">
                      <p class="post-description"> <?php echo $description; ?> </p>
                    </div>
                    <span class="post-date"><i class="fa fa-clock-o"></i><?php echo $updatedAt; ?></span>
                    <a href="blog-detail.php?id=<?php echo $id; ?>" class="read-more undecorated-links">read more</a>
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
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
  
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