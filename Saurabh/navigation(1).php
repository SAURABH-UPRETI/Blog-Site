<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
  <div class="container">
    <a class="navbar-brand" href="index.php">Saurabh Upreti Blogs</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
        <li class="nav-item me-5">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item me-5 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              include './admin/private/connection.php';

              $sqlFetchCategories = "SELECT * FROM `blog_categories` WHERE `display` = 1";
              $resFetchCategories = mysqli_query($con, $sqlFetchCategories);
              if(mysqli_num_rows($resFetchCategories)) {
                while($recFetchCategories = mysqli_fetch_assoc($resFetchCategories)) {
                  $id = $recFetchCategories['id'];
                  $category = $recFetchCategories['category'];
            ?>
                  <li><a class="dropdown-item" href="category.php?cat=<?php echo$id; ?>"><?php echo $category; ?></a></li>
            <?php
                }
              }
            ?>
          </ul>
        </li>
        <li class="nav-item me-5">
          <a class="nav-link" href="about.php" tabindex="-1" aria-disabled="true">About Us</a>
        </li>
        <li class="nav-item me-5">
          <a class="nav-link" href="contact.php" tabindex="-1" aria-disabled="true">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>