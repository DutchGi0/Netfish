
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="components/favicon//apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="components/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="components/favicon//favicon-16x16.png">
    <link rel="manifest" href="components/favicon//site.webmanifest">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <script>
      function logout() {
        var logout = confirm('Are you sure you want to logout?')
        if (logout) {
          location.href = 'index.php?page=logout'
        }
      }
    </script>
  </head>
  <body>
    <?php if (!isset($_SESSION['USER_ID'])) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand " href="index.php?page=homepage">
        <img src="img/logo.jpg" class="logo" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=homepage">Home <span class="sr-only">(current)</span></a>
          </li>
          <!-- Account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Account
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="accountDropdown">
                  <a class="dropdown-item" href="index.php?page=login">Login</a>
                  <a class="dropdown-item" href="index.php?page=register">Register</a>
                  <a class="dropdown-item" href="index.php?page=password_reset">Forgot Password</a>
                </div>
              </li>
        </ul>
      </div>
    </nav>
    <?php } ?>
    
    
   
      <?php if (isset($_SESSION['ID']) && $_SESSION['STATUS'] == 'ACTIEF') {
          if ($_SESSION['ROL'] == 0) { ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand " href="index.php?page=homepage">
            <img src="img/logo.jpg" class="logo" alt="Logo">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php?page=homepage">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=movies">Movies</a>
              </li>
              <!-- Manage account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['USER_ID']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="accountDropdown">
                  <a class="dropdown-item" href="index.php?page=profile">View Account</a>
                  <a class="dropdown-item" onclick="logout()">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Logged in as admin -->
      <?php } elseif ($_SESSION['ROL'] == 1) { ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand " href="index.php?page=homepage">
            <img src="img/logo.jpg" class="logo" alt="Logo">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php?page=homepage">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=movies">Movies</a>
              </li>
              <!-- Manage movies -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Manage
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="adminDropdown">
                  <a class="dropdown-item" href="index.php?page=movie_overview">Movie Overview</a>
                  <a class="dropdown-item" href="index.php?page=movie_add">Add new movies</a>
                  <hr class="dropdown-divider">
                  <a class="dropdown-item" href="index.php?page=user_overview">User Overview</a>
                </div>
              </li>
              <!-- Manage account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['USER_ID']; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="accountDropdown">
                  <a class="dropdown-item" href="index.php?page=profile">View Account</a>
                  <a class="dropdown-item" onclick="logout()">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      <?php }
      } ?>
    </div>
  </body>
</html>
