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
    <?php
      include './admin/private/connection.php';
      if(isset($_GET['cat'])) {
        $cat = $_GET['cat'];
        $sqlFetchCategoryWise = "SELECT * FROM `blogs` WHERE `blog_category` = '$cat' LIMIT 10";
        $resFetchCategoryWise = mysqli_query($con, $sqlFetchCategoryWise);

        if(mysqli_num_rows($resFetchCategoryWise) > 0) {
    ?>
          <div class="row mt-5 mb-5">
            <div class="col-md-8">

            <?php
              while($recFetchCategoryWise = mysqli_fetch_assoc($resFetchCategoryWise)) {
                $id = $recFetchCategoryWise['id'];
                $blog_title = $recFetchCategoryWise['blog_title'];
                $description = $recFetchCategoryWise['description'];
                $image_url = $recFetchCategoryWise['image_url'];
            ?>
                
                <div class="container-fluid mt-2 home-blogs p-3">
                  <img src="./assets/images/<?php echo $image_url; ?>" class="home-blog-image" alt="">
                  <div>
                    <h5 class="text-uppercase"><?php echo $blog_title; ?></h5>
                    <div class="fixed-height">
                      <p class="text-secondary"> <?php echo $description; ?> </p>
                    </div>
                    <button class="btn btn-lg btn-secondary mt-2">Read more &nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                  </div>
                </div>
                
          <?php
            }
          ?>

            </div>
            <div class="col-md-4">
              <div class="container-fluid mt-4">
                <div class="card p-3 categories-card">
                  <h5 class="text-secondary text-center">Categories</h5>
                  <?php
                    $sqlFetchCategories = "SELECT * FROM `blog_categories` WHERE 1";
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
    <?php
        } else {
    ?>
          <h3 class="text-center text-danger mt-5"> No Post Availble</h3>
    <?php
        }
      }
    ?>
  </div>

  <?php include 'footer.php' ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> 
</body>
</html>