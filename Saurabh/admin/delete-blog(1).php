<?php session_start(); ?>
<?php
  if(!$_SESSION['admin_name'] && !$_SESSION['admin_email']){
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
  <link href="./assets/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <?php include 'navigation.php'; ?>

  <div class="container-fluid mt-5">
    <?php
      if(isset($_GET['id']) && isset($_GET['title'])) {
        $bid = $_GET['id'];
        $btitle = $_GET['title'];
    ?>
      <h3 class="text-center text-danger text-capitalize"> Are you sure want to delete this Post ?</h3>
      <h6 class="text-center text-secondary text-uppercase"> (<?php echo $_GET['title']; ?>) </h6>
      <div class="mt-3">
        <form action="delete-blog.php" method="post">
          <input type="hidden" name="blog_id" value="<?php echo $bid; ?>">
          <input type="hidden" name="blog_title" value="<?php echo $btitle; ?>">
          <div class="container text-center">
            <a href="blogs.php" class="btn btn-secondary"> <i class="fas fa-times"></i> Cancel </a> &nbsp;&nbsp;
            <button type="submit" name="delete_confirmation" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Delete</button>
          </div>
        </form>
      </div>
    <?php
      }
    ?>
  </div>

  <?php
    include './private/connection.php';
    if(isset($_POST['delete_confirmation'])) {
      $blog_id = $_POST['blog_id'];
      $blog_title = $_POST['blog_title'];

      $sql = "DELETE FROM `blogs` WHERE `id` = '$blog_id' AND `blog_title` = '$blog_title'";
      $res = mysqli_query($con, $sql);

      if($res) { 
        echo "<script> alert('Blog Deleted Successfully.'); </script>";
        echo "<script> window.open('blogs.php', '_self'); </script>";
      } else {
        echo "<script> alert('Something went wrong Please try again later.'); </script>";
        echo "<script> window.open('blogs.php', '_self'); </script>";
      }
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>