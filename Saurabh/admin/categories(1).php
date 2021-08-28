<?php session_start(); ?>
<?php
  if(!$_SESSION['admin_name'] && !$_SESSION['admin_email']){
    header("Location: signin.php");
  }
?>

<?php include './private/connection.php'; ?>

<?php
  if(isset($_GET['id']) && isset($_GET['display'])) {
    $catID = $_GET['id'];
    if($_GET['display'] == 0) 
      $disp = 1;
    else 
      $disp = 0;
    $sqlDisp = "UPDATE `blog_categories` SET `display` = '$disp' WHERE `id` = '$catID'";
    $resDisp =  mysqli_query($con, $sqlDisp);

    if($resDisp) {
      echo "<script> alert('Category display status changed successfully'); </script>";
      echo "<script> window.open('categories.php', '_self'); </script>";
    } else {
      echo "<script> alert('Error occured while changing Category display status'); </script>";
      echo "<script> window.open('categories.php', '_self'); </script>";
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" />
  <link href="./assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <?php include 'navigation.php'; ?>

  <div class="container mt-5">
    <h3 class="text-center"> Add Category </h3>
    <div class="form-group text-center">
      <form action="" method="post">
        <input type="text" class="form-control mt-4" name="category" placeholder="Enter Category" />
        <button type="submit" name="add_category" class="btn btn-primary mt-3"><i class="zmdi zmdi-plus" aria-hidden="true"></i> Add new Category</button>
      </form>
    </div>
  </div>

  <div class="container">
    <div class="container-fluid">
      <h3 class="text-center mt-5">Existing Categories</h3>
      <div class="container-fluid">
        <?php
          $sqlCat = "SELECT * FROM `blog_categories` WHERE 1";
          $resCat = mysqli_query($con, $sqlCat);
          if($resCat) {
            while($recCat = mysqli_fetch_assoc($resCat)) {
              $categoryId = $recCat['id'];
              $categoryName = $recCat['category'];
              $display = $recCat['display'];
              
        ?>
                  <div class="row">
                    <div class="col-md-6">
                      <span class="text-end"> <?php echo $categoryName; ?>  <?php if($display != 1) { ?> <span class="small text-secondary">(Hidden)</span> <?php } ?> </span> 
                    </div>
                    <div class="col-md-6 text-md-end text-sm-start">
                      <span>
                        <span class="text-center"> <span class="text-primary" data-bs-toggle="collapse" href="#collapse<?php echo $categoryId; ?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo $categoryId; ?>"> <i class="fas fa-edit"></i> Edit </span> &nbsp; 
                          <?php
                            if($display == 1) {
                          ?>
                              <a href="categories.php?id=<?php echo $categoryId; ?>&display=<?php echo $display; ?>" class="text-danger undecorated-links"> 
                                <i class="fas fa-eye-slash"></i> Hide 
                              </a> 
                          <?php
                            } else {
                          ?>
                              <a href="categories.php?id=<?php echo $categoryId; ?>&display=<?php echo $display; ?>" class="text-primary undecorated-links"> 
                                <i class="fas fa-eye"></i> Show 
                              </a> 
                          <?php
                            }
                          ?>
                      </span>
                    </div>
                  </div>
                  <div class="collapse" id="collapse<?php echo $categoryId; ?>">
                    <div class="card card-body">
                      <form action="" method="post">
                        <input type="hidden" name="categoryID" class="form-control" value="<?php echo $categoryId; ?>">
                        <input type="text" name="updatedCategoryName" class="form-control" value="<?php echo $categoryName; ?>">
                        <div class="text-end">
                          <button class="btn btn-info waves-effect mt-2" type="submit" name="updateCat"> <i class="fas fa-pen-alt"></i> Update</button>
                          <span class="btn btn-secondary mt-2" data-bs-toggle="collapse" href="#collapse<?php echo $categoryId; ?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo $categoryId; ?>"> <i class="fas fa-times-circle"></i> Cancel</span>
                        </div>
                      </form>
                    </div>
                  </div>
              <hr/>
        <?php
            }
          }
        ?>
      </div>
    </div> 
  </div>

  

  <?php
    if(isset($_POST['add_category'])) {
      $category = $_POST['category'];
      $sql = "INSERT INTO `blog_categories` (`category`) VALUES ('$category')";
      $res = mysqli_query($con, $sql);
      if($res) 
        echo "<script> alert('Category Created Sucessfully'); </script>";
      else
        echo "<script> alert('Oops Something Went wrong..'); </script>";

    }
  ?>

  <?php
    if(isset($_POST['updateCat'])) {
      $categoryID = $_POST['categoryID'];
      $updatedCategoryName = $_POST['updatedCategoryName'];
      $sql = "UPDATE `blog_categories` SET `category` = '$updatedCategoryName' WHERE `id` = '$categoryID'";
      $res = mysqli_query($con, $sql);
      if($res) {
        echo "<script> alert('Category Updated Sucessfully'); </script>";
        echo "<script> window.open('categories.php', '_self'); </script>";
      }
      else
        echo "<script> alert('Oops Something Went wrong..'); </script>";
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  
</body>
</html>