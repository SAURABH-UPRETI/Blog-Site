<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light p-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item me-5">
          <a class="nav-link" aria-current="page" href="index.php"> <i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item me-5 dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fab fa-blogger-b"></i> Blog
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="blogs.php">Blogs</a></li>
            <li><a class="dropdown-item" href="add-blog.php">Add Blog</a></li>
            <li><a class="dropdown-item" href="categories.php">Blog Categories</a></li>
          </ul>
        </li>
        <li class="nav-item me-5">
          <a class="nav-link" href="queries.php" tabindex="-1" aria-disabled="true"> <i class="fas fa-question-circle"></i> Queries </a>
        </li>
        <li class="nav-item me-5">
          <a class="nav-link" href="signout.php" tabindex="-1" aria-disabled="true"> <i class="fas fa-power-off"></i> Sign Out </a>
        </li>
      </ul>
    </div>
  </div>
</nav>