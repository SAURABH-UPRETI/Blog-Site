<?php session_start(); ?>
<?php
  if(!isset($_SESSION['admin_name']) && !isset($_SESSION['admin_email'])){
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

  <div class="container-fluid">
    <div class="container">
      <form action="" method="post"  enctype="multipart/form-data">
        <label for="blog_title">Enter Title</label>
        <input type="text" name="blog_title" id="blog_title" class="form-control mb-2" placeholder="Enter Blog Title..." required>
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
                <option value="<?php echo $id; ?>"> <?php echo $category; ?></option>
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
        <hr/>
        <label for="featured"> Featured Blog</label>
        <input type="checkbox" name="featured" class="mb-2" id="featured"><hr/>
        <label for="meta_keyowrds">Enter Meta Keywords</label>
        <textarea name="meta_keyowrds" id="meta_keyowrds" class="form-control mb-2" placeholder="Enter Meta Keywords"></textarea>
        <label for="meta_description">Enter Meta Description</label>
        <textarea name="meta_description" id="meta_description" class="form-control mb-2" placeholder="Enter Meta Description"></textarea>
        <label for="editor">Enter Blog Description</label>
        <textarea name="blog_description" class="form-control mt-2 mb-2" id="editor"></textarea>
        <div class="text-md-end text-sm-start">
          <a href="index.php" class="btn btn-lg btn-secondary mt-2"> Cancel</a>
          <input type="submit" name="add_blog" class="btn btn-lg btn-primary mt-2" value="Add Blog">
        </div>
      </form>
    </div>
  </div>

  <?php
    if(isset($_POST['add_blog'])) {
      $currentDate = date("d-m-y");
      $title = $_POST['blog_title'];
      $category = $_POST['blog_category'];
      $meta_keywords = $_POST['meta_keyowrds'];
      $meta_description = $_POST['meta_description'];
      $description = $_POST['blog_description'];
      $featured = 0;
      if(isset($_POST['featured']))
        $featured = 1;
      
      $blog_imageName = "default.png";

      // echo $filePath;
      if(isset($_FILES['blog_image'])) {
        $blog_image = $_FILES['blog_image']['tmp_name'];
        $array = explode('.', $_FILES['blog_image']['name']);
        $extension = end($array);
        $fileName = $currentDate."_".uniqid().".".$extension;
        $blog_imageName = $fileName;
        $filePath = "../assets/images/".$fileName;

        // echo $filePath;
        if(!move_uploaded_file($blog_image, $filePath)) 
          echo "<script> alert('Error occured while uploading image'); </script>";
      }

      $sqlInsert = "INSERT INTO `blogs` (`blog_title`, `blog_category`, `meta_keywords`, `meta_description`, `description`, `image_url`, `featured`, `createdAt`) VALUES ('$title', '$category', '$meta_keywords', '$meta_description', '$description', '$blog_imageName', $featured, '$currentDate')";
      $resInsert = mysqli_query($con, $sqlInsert);

      if($resInsert) {
        echo "<script> alert('Blog created Successfully'); </script>";
        echo "<script> wimdow.open('blogs.php', '_self'); </script>";
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