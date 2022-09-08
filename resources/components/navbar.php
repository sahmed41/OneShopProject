<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="?resources/pages/site_pages/0_home.php">OneShop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
            foreach ($pages as $page) {
                $pageTitle = str_replace('.php','',str_replace('resources/pages/site_pages/','',$page));
                $pageTitle = ucfirst(substr_replace($pageTitle,"",0,2));
                if ($content == $page) {
                  echo '<li class="nav-item">';
                  echo    '<a class="nav-link fw-bold main-nav" href="?link=' . $page . '">' . $pageTitle  . '</a>';
                  echo  '</li>'; 
                } else {
                  echo '<li class="nav-item">';
                  echo    '<a class="nav-link main-nav" href="?link=' . $page . '">' . $pageTitle  . '</a>';
                  echo  '</li>'; 
                }
            }
        ?>
      </ul>
      <!-- navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0 -->
      <ul class="navbar-nav justify-content-end">
        <?php
            if (isset($_SESSION['user_name'])) {
                echo '<li class="nav-item dropdown">';
                    echo '<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">';
                    echo    $_SESSION['first_name'] . " " . $_SESSION['last_name'];
                    echo '</a>';
                    echo '<ul class="dropdown-menu" style="margin-right: 50px;">';
                    if ($_SESSION['role'] == 'seller') {
                      $user_pages = glob('resources/pages/user_pages/*.php');
                      foreach ($user_pages as $user_page) {
                          echo '<li><a class="dropdown-item" href="?link=' . $user_page . '">' . ucfirst(str_replace('.php','',str_replace('resources/pages/user_pages/','',$user_page))) . '</a></li>';
                      }
                      echo     '<li><hr class="dropdown-divider"></li>';
                      echo    '<li><a class="dropdown-item" href="_engine/_user_logout.php">Logout</a></li>';
                    } else {
                      echo    '<li><a class="dropdown-item" href="_engine/_user_logout.php">Logout</a></li>';
                    }
                    echo '</ul>';
                echo '</li>';
                echo '&nbsp';
                echo '&nbsp';
                echo '&nbsp';
                echo '&nbsp';
                echo '&nbsp';
                echo '&nbsp';
                echo '&nbsp';
            } else {
                echo '<li class="nav-item">';
                echo    '<a class="nav-link" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Login</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo    '<a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Register</a>';
                echo '</li>';

            }
        ?>
      </ul>
    </div>
  </div>
</nav>


