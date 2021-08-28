<?php session_start(); ?>
<?php
  if(!$_SESSION['admin_name'] && !$_SESSION['admin_email']){
    header("Location: signin.php");
  }
?>

<?php require './private/connection.php'; ?>

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
  <?php include 'navigation.php'; ?>

  <?php 
    if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql = "SELECT * FROM `blogs` WHERE `id` = '$id'";
      $res = mysqli_query($con, $sql);
      if($res) {
        while($rec = mysqli_fetch_assoc($res)) {
          $blog_title = $rec['blog_title'];
          $blog_category = $rec['blog_category'];
          $description = $rec['description'];
          $meta_keywords = $rec['meta_keywords'];
          $meta_description = $rec['meta_description'];
          $image_url = $rec['image_url'];
          $featured = $rec['featured'];
          $createdAt = $rec['createdAt'];
          $updatedAt = $rec['updatedAt'];

          $sqlCat = "SELECT * FROM `blog_categories` WHERE `id` = '$blog_category'";
          $resCat = mysqli_query($con, $sqlCat);
          if($resCat) {
            while($recCat = mysqli_fetch_assoc($resCat))
              $category = $recCat['category'];
          }
  ?>
        <div class="container mt-2 mb-3">
          <img src="../assets/images/<?php echo$image_url;?>" class="img-fluid" alt="<?php echo $blog_title; ?>">
          <div class="mt-3">
            <h3 class="text-capitalize"><?php echo $blog_title; ?> &nbsp; <span class="h5 text-secondary"> (<?php echo $category; ?>) </span> </h3>
            <span class="text-secondary"> 
              <p class="small"> Created At: <?php echo $createdAt; ?></p>
              <p class="small"> Last Updated At: <?php echo $updatedAt; ?></p> 
              <?php
                if($featured != 0) {
              ?>
                  <p class="small text-primary">(Featured Blog)</p> 
              <?php
                }
              ?>
            </span>
            
            <div class="p-2 mt-2 mb-2">
              <p class="text-secondary text-justify"><?php echo $description; ?></p>
            </div>

            <div class="mt-2 mb-2 p-2">
              <p class="text-secondary h6">Meta Keywords</p>
              <p class="text-secondary"><?php echo $meta_keywords ?></p>
            </div>
            <div class="mt-2 mb-2 p-2">
              <p class="text-secondary h6">Meta Description</p>
              <p class="text-secondary"><?php echo $meta_description ?></p>
            </div>
          </div>
          <div class="text-md-end mt-3">
            
            
              <a href="blogs.php" class="btn btn-secondary"> <i class="fas fa-times"></i> Cancel</a> &nbsp;&nbsp;
              <a href="delete-blog.php?id=<?php echo$id; ?>&title=<?php echo $blog_title; ?>" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Delete</a>&nbsp;&nbsp;
              <a href="edit-blog.php?id=<?php echo $id;?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
            
          </div>
        </div>
  <?php
        }
      }
    } else {
  ?>
      <h3 class="container mt-3 text-center text-danger">No Post Availble</h3>
  <?php
    }
  ?>

  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>