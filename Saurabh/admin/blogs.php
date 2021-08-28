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

  <div class="mt-3">
    <h3 class="text-primary text-center mb-3">Blogs</h3>
    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed text-center text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Filter
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <div class="row text-md-center text-sm-start">
              <div class="col-md-4">
                <a href="blogs.php?sort=latest" class="undecorated-links">
                  Latest First
                </a>
              </div>
              <div class="col-md-4">
                <a href="blogs.php?sort=oldest" class="undecorated-links">
                  Oldest First
                </a>
              </div>
              <div class="col-md-4">
                  <a class="undecorated-links" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  By Date
                  </a>
                <div class="collapse" id="collapseExample">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-9">
                        <input type="date" class="form-control" name="date" id="">
                      </div>
                      <div class="col-md-3">
                        <input type="submit" class="btn btn-primary" value="Search">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt-3 blog-table-container">
      <table class="table table-striped table-hover">
        <th>S. no.</th>
        <th>Title</th>
        <th>Category</th>
        <th>Featured</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>View</th>
        <th>Edit</th>

        <?php
          $sql = "SELECT * FROM `blogs` WHERE 1 ORDER BY `id` DESC";
          if(isset($_GET['sort'])) {
            if($_GET['sort'] == 'latest')
              $sql = "SELECT * FROM `blogs` WHERE 1 ORDER BY `id` DESC";
            if($_GET['sort'] == 'oldest')
              $sql = "SELECT * FROM `blogs` WHERE 1";
          }
          if(isset($_POST['date'])) {
            $date = $_POST['date'];
            $day = strtotime($date);
            $dayPlusOne = strtotime("$date + 1 day");
            $day = date('Y-m-d H:i:s', $day);
            $dayPlusOne = date('Y-m-d H:i:s', $dayPlusOne);
            $sql = "SELECT * FROM `blogs` WHERE DATE(createdAt) >= DATE('$day') and DATE(createdAt) <= DATE('$dayPlusOne')";
          }
          $res = mysqli_query($con, $sql);
          if(mysqli_num_rows($res) > 0) {
            while($rec = mysqli_fetch_assoc($res)) {
              $id = $rec['id'];
              $blog_title = $rec['blog_title'];
              $featured = $rec['featured'];
              $categoryId = $rec['blog_category'];
              $createdAt = $rec['createdAt'];
              $updatedAt = $rec['updatedAt'];

              $catSql = "SELECT * FROM `blog_categories` WHERE `id` = '$categoryId'";
              $resSql = mysqli_query($con, $catSql);

              while($recSql = mysqli_fetch_assoc($resSql))
                $blog_category = $recSql['category'];
        ?>
              <tr>
                <td> <?php echo $id; ?> </td>
                <td> <?php echo $blog_title; ?> </td>
                <td> <?php echo $blog_category; ?> </td>
                <td> 
                  <?php 
                    if($featured == 0) 
                      echo "Not Featured"; 
                    else 
                      echo "Featured Blog";
                  ?> 
                </td>
                <td> <?php echo $createdAt; ?> </td>
                <td> <?php echo $updatedAt; ?> </td>
                <td> <a href="blog-detail.php?id=<?php echo $id; ?>" class="undecorated-links"> <span class="text-primary"> <i class="fas fa-eye"></i> View </span> </a> </td>
                <td> <a href="edit-blog.php?id=<?php echo $id;?>" class="undecorated-links"> <span class="text-warning"> <i class="fas fa-edit"></i> Edit </span> </a> </td>
              </tr>
        <?php
            }
          } else {
        ?>  
            <h3 class="text-center text-danger">No Posts Availble</h3>
        <?php
          }
        ?>
      </table>

      
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>