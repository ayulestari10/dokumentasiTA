
  <body>

    <!-- Navigation -->
    <!-- <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <a class="btn btn-primary" href="#">Sign In</a>
      </div>
    </nav> -->

     <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?= base_url('home') ?>">Dokumentasi TA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto" style="margin-left: -20%; margin-right: -10%;">
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url('home') ?>" >Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item" ">
              <?php if(isset($username)):  ?>
                  <a class="nav-link" href="<?= base_url('login') ?>">Dashboard</a>
                  <a class="nav-link" href="<?= base_url('logout') ?>">Logout</a>
              <?php else: ?>
                  <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
</nav>