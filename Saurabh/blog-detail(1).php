<?php
  if(isset($_GET['blog'])) {
    include './admin/private/connection.php';

    $id = $_GET['blog'];
    $sqlFetchBlog = "SELECT * FROM `blogs` WHERE `id` = '$id'";
    $resFetchBlog = mysqli_query($con, $sqlFetchBlog);
    if(mysqli_num_rows($resFetchBlog) > 0) {
      while($recFetchBlog = mysqli_fetch_assoc($resFetchBlog)) {
        $blog_title = $recFetchBlog['blog_title'];
        $blog_category = $recFetchBlog['blog_category'];
        $meta_keywords = $recFetchBlog['meta_keywords'];
        $meta_description = $recFetchBlog['meta_description'];
        $description = $recFetchBlog['description'];
        $image_url = $recFetchBlog['image_url'];
        $createdAt = $recFetchBlog['createdAt'];
?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="description" content="<?php echo $meta_description; ?>">
          <meta name="keywords" content="<?php echo $meta_keywords; ?>">
          <meta name="author" content="Saurabh Upreti">
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


            
            <div class="row mt-2 mb-5">
              <div class="col-md-8">
                <div class="container-fluid mt-2 home-blogs p-3">
                  <img src="./assets/images/<?php echo$image_url; ?>" class="home-blog-image" alt="">
                  <div>
                    <h4 class="mt-4 mb-4 text-uppercase"><?php echo $blog_title; ?></h4>
                    <p class="text-break"> <?php echo $description; ?> </p>
                    <hr/>

                    <div class="text-end">
                      
                      <span class="h5">
                        <i class="fa fa-whatsapp me-2 text-success" aria-hidden="true"></i> 
                        <i class="fa fa-facebook me-2 text-primary" aria-hidden="true"></i>
                        <i class="fa fa-instagram me-2 text-danger" aria-hidden="true"></i>
                      </span>

                    </div>


                  </div>
                </div>
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
        </body>
        </html>

<?php
      }
    }
  } else {
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
      </body>
    </html>
<?php
  }
?>


