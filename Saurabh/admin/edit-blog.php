<?php session_start(); ?>
<?php
  if(!$_SESSION['admin_name'] && !$_SESSION['admin_email']){
    header("Location: signin.php");
  }
?>

<?php include './private/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saurabh Upreti Blog Admin Add Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" />
  <link href="./assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <?php include 'navigation.php'; ?>
  <?php 
    if(isset($_GET['id'])) {
      $blog_id = $_GET['id'];
      $sql = "SELECT * FROM `blogs` WHERE `id` = '$blog_id'";
      $res = mysqli_query($con, $sql);

      if($res) {
        while($rec = mysqli_fetch_assoc($res)) {
          $blog_title = $rec['blog_title'];
          $blog_category = $rec['blog_category'];
          $meta_keywords = $rec['meta_keywords'];
          $meta_description = $rec['meta_description'];
          $description = $rec['description'];
          $image_url = $rec['image_url'];
          $featured = $rec['featured'];
  ?>
          <div class="container-fluid mb-5">
            <div class="container">
              <form action="" method="post"  enctype="multipart/form-data">
              <input type="hidden" name="existingId" value="<?php echo $blog_id; ?>">
                <label for="blog_title">Enter Title</label>
                <input type="text" name="blog_title" id="blog_title" class="form-control mb-2" placeholder="Enter Blog Title..." value="<?php echo $blog_title; ?>" required>
                <label for="blog_category">Select Category</label>
                <select name="blog_category" id="blog_category" class="form-control mb-2" id="" required>
                  <?php
                    $sql = "SELECT * FROM  `blog_categories` WHERE 1";
                    $res = mysqli_query($con, $sql);
                    if($res) {
                      while($rec = mysqli_fetch_assoc($res)) {
                        $id = $rec['id'];
                        $category = $rec['category'];
                  ?>
                        <option value="<?php echo $id; ?>" <?php if($id == $blog_category) echo 'selected'; ?>> <?php echo $category; ?></option>
                  <?php
                      }
                    } else {
                  ?>
                      <option value="1"> No Category Availble </option>
                  <?php
                    }
                  ?>
                </select>
                <label for="blog_image">Choose Image</label>
                <input type="file" name="blog_image" id="blog_image" class="form-control mb-2">
                <input type="hidden" name="existing_image" value="<?php echo$image_url;?>">
                <?php
                  if($image_url) {
                ?>
                    <h5 class="text-secondary mt-3">Existing Image</h5>
                    <img src="../assets/images/<?php echo$image_url; ?>" style="height: 200px; width:300px;" alt="">
                <?php
                  }
                ?>
                <hr/>
                <label for="featured"> Featured Blog</label>
                <input type="checkbox" name="featured" class="mb-2" id="featured" <?php if($featured != 0) echo 'checked'; ?>><hr/>
                <label for="meta_keyowrds">Enter Meta Keywords</label>
                <textarea name="meta_keyowrds" id="meta_keyowrds" class="form-control mb-2" placeholder="Enter Meta Keywords"><?php echo$meta_keywords;?></textarea>
                <label for="meta_description">Enter Meta Description</label>
                <textarea name="meta_description" id="meta_description" class="form-control mb-2" placeholder="Enter Meta Description"><?php echo$meta_description;?></textarea>
                <label for="editor">Enter Blog Description</label>
                <textarea name="blog_description" class="form-control mt-2 mb-2" id="editor"><?php echo$description;?></textarea>
                <div class="text-md-end text-sm-start mt-2">
                  <a href="index.php" class="btn btn-lg btn-secondary mt-2 me-2">Cancel</a>
                  <input type="submit" name="update_blog" class="btn btn-lg btn-primary mt-2" value="Update Blog">
                </div>
              </form>
            </div>
          </div>
  <?php
        }
      }
    } else {
  ?>
      <h1 class="text-danger text-center mt-5">No Posts Availble</h1>
  <?php
    }
  ?>
  

  <?php
    if(isset($_POST['update_blog'])) {
      $currentDate = date("d-m-y");
      $title = $_POST['blog_title'];
      $existingId = $_POST['existingId'];
      $category = $_POST['blog_category'];
      $meta_keywords = $_POST['meta_keyowrds'];
      $meta_description = $_POST['meta_description'];
      $description = $_POST['blog_description'];
      $featured = 0;
      $existingImage = $_POST['existing_image'];
      if(isset($_POST['featured']))
        $featured = 1;
      
      $blog_imageName = $existingImage;

      // echo $_FILES['blog_image']['name'];

      // echo $filePath;
      if($_FILES['blog_image']['name'] != "") {
        $blog_image = $_FILES['blog_image']['tmp_name'];
        $array = explode('.', $_FILES['blog_image']['name']);
        $extension = end($array);
        $fileName = $currentDate."_".uniqid().".".$extension;
        $blog_imageName = $fileName;
        $filePath = "../assets/images/".$fileName;

        $existingFileLocation = "../assets/images/".$existingImage;
        unlink($existingFileLocation);

        if(!move_uploaded_file($blog_image, $filePath)) 
          echo "<script> alert('Error occured while uploading image'); </script>";
      }

      $sqlUpdate = "UPDATE `blogs` SET `blog_title` = '$title', `blog_category` = '$category', `meta_keywords` = '$meta_keywords', `meta_description` = '$meta_description', `description` = '$description', `image_url` = '$blog_imageName', `featured` = '$featured' WHERE `id` = '$existingId'";
      $resUpdate = mysqli_query($con, $sqlUpdate);

      if($resUpdate) {
        echo "<script> alert('Blog Updated Successfully'); </script>";
        echo "<script> window.open('blogs.php', '_self'); </script>";
      } else {
        echo "<script> alert('Oops. Something went Wrong..'); </script>";
      }
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
  <script>
      ClassicEditor
          .create( document.querySelector( '#editor' ) )
          .catch( error => {
              console.error( error );
          } );
  </script>
</body>
</html>