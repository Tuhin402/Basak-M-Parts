<?php 
include 'session_config.php';
include 'headerlink.php'; 
?>

  <body class="preload-wrapper">
    <!-- Scroll Top -->
    <button id="scroll-top">
      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_15741_24194)">
          <path
            d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
            stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </g>
        <defs>
          <clipPath id="clip0_15741_24194">
            <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"></rect>
          </clipPath>
        </defs>
      </svg>
    </button>

    <!-- preload -->
    <div class="preload preload-container">
      <div class="preload-logo">
        <div class="spinner"></div>
      </div>
    </div>
    <!-- /preload -->

    <!-- #wrapper -->
    <div id="wrapper">
      <!-- Top Bar -->

      <?php include 'header.php'; ?>

      <!-- page-title -->
      <?php 
      $imageQuery = "SELECT * FROM banner LIMIT 1";
      $bans = $obj->fetch($imageQuery);
      foreach ($bans as $ban){ 
      ?>
      <div class="page-title" style="background-image: url('../Admin/uploads/banner/<?= htmlspecialchars($ban['b2c_image']) ?>');">
          <div class="container">
              <h3 class="heading text-center">Login Your Account</h3>
              <ul class="breadcrumbs d-flex align-items-center justify-content-center">
                  <li><a class="link" href="index.php">Home</a></li>
                  <li><i class="icon-arrRight"></i></li>
                  <li>Login</li>
              </ul>
          </div>
      </div>
      <?php } ?>
      <!-- /page-title -->

      <!-- login -->
      <section class="flat-spacing">
        <div class="container">
          <div class="login-wrap">
            <div class="left">
              <div class="heading">
                <h4>Business to Customer Login</h4>
              </div>
              <form id="loginBtoC" class="form-login form-has-password">
                <div class="wrap">
                  <fieldset class="">
                    <input class="" type="email" placeholder="Email address*" name="email" tabindex="2" value="" aria-required="true" required=""/>
                  </fieldset>
                  <fieldset class="position-relative password-item">
                    <input class="input-password" type="password" placeholder="Password*" name="password" tabindex="2" value="" aria-required="true" required=""/>
                    <span class="toggle-password unshow">
                      <i class="icon-eye-hide-line"></i>
                    </span>
                  </fieldset>
                  <div class="d-flex align-items-center justify-content-between">
                    <a href="forget_password.php" class="font-2 text-button forget-password link">Forgot Your Password?</a>
                  </div>
                </div>
                <div class="button-submit">
                  <button class="tf-btn btn-fill" type="submit">
                    <span class="text text-button">Login</span>
                  </button>
                </div>
              </form>
            </div>
            <div class="right">
              <h4 class="mb_8">New Customer</h4>
              <p class="text-secondary">
                Be part of our growing family of new customers! Join us today
                and unlock a world of exclusive benefits, offers, and
                personalized experiences.
              </p>
              <a href="register.php" class="tf-btn btn-fill">
                <span class="text text-button">Register</span>
              </a>
            </div>
          </div>
        </div>
      </section>
      <!-- /login -->

      <!-- Footer -->
      <?php include 'footer.php'; ?>
      <!-- /Footer -->

    </div>
    <!-- /wrapper -->

    <!-- search -->
    <?php include 'search.php'; ?>
    <?php include 'general_search.php'; ?>
    <!-- /search -->

    <!-- Javascript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/lazysize.min.js"></script>
    <script type="text/javascript" src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/count-down.js"></script>
    <script type="text/javascript" src="js/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="js/carousel.js"></script>
    <script type="text/javascript" src="js/multiple-modal.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    
    <script>
      // login script
      $(document).ready(function () {
        $("#loginBtoC").on("submit", function (e) {
          e.preventDefault(); 
          const formData = {
            email: $("input[name='email']").val(),
            password: $("input[name='password']").val()
          };
          $.ajax({
            url: "login_btoc.php", 
            type: "POST",
            data: formData,
            success: function (response) {
              const res = JSON.parse(response); 
              if (res.status === "success") {
                  Toastify({
                    text: "Login successful! Redirecting...",
                    duration: 2000,
                    gravity: "top",
                    position: "center",
                    style: {
                      background: "#28a745",
                    },
                  }).showToast();
                  setTimeout(function () {
                    window.location.href = res.redirect; 
                  }, 2000);
              } else {
                Toastify({
                  text: res.message,
                  duration: 3000,
                  gravity: "top",
                  position: "center",
                  style: {
                    background: "#dc3545",
                  },
                }).showToast();
              }
            },
            error: function () {
              Toastify({
                text: "An error occurred. Please try again.",
                duration: 3000,
                gravity: "top",
                position: "center",
                style: {
                  background: "#dc3545",
                },
              }).showToast();
            },
          });
        });
      });
    </script>

  </body>
</html>