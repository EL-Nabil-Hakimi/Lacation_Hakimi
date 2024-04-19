<!doctype html>
<html lang="en">

  <head>
    <title>Car Rent &mdash; Free Website Template by Hakimi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=DM+Sans:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/Client/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/Client/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/Client/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/Client/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="assets/Client/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/Client/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/Client/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="assets/Client/css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="assets/Client/css/style.css">

  </head>

  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>


      <header class="site-navbar site-navbar-target" role="banner">

        <div class="container">
          <div class="row align-items-center position-relative">

            <div class="col-3 ">
              <div class="site-logo">
                <a href="index.html">Location.Hakimi</a>
              </div>
            </div>

          </div>
        </div>

      </header>

    <div class="ftco-blocks-cover-1">
      <div class="ftco-cover-1 overlay" style="background-image: url('assets/Client/images/login-image.jpg')">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-5">
              <div class="feature-car-rent-box-1">
                <h3>Register</h3>
                <form class="feature-list" method="POST" action="/signup">
                  <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <label for="username">Username:</label>
                      <input type="text" id="username" name="name" class="form-control border-bottom"  required>
                    </div>
                    <div class="form-group">
                      <label for="username">Email:</label>
                      <input type="text" id="username" name="email" class="form-control border-bottom"  required>
                    </div>
                    <div class="form-group">
                      <label for="username">Password:</label>
                      <input type="text" id="username" name="password" class="form-control border-bottom"  required>
                    </div>
                    <div class="form-group">
                      <label for="password">Comfirm Password:</label>
                      <input type="password" id="password" name="c_password"  class="form-control border-bottom" required>
                    </div>
                        <div class="form-group">
                          <button type="submit" style="width: 100%" class="btn btn-primary">Create Account</button>

                          <div class="container mt-3" style="display:flex; justify-content:space-between; align-items:center;">
                            <div>
                                <input type="checkbox" id="rememberMe" style="scale: 1.2"> 
                                <label for="rememberMe">Remember me</label>
                            </div>
                            <div>
                                <a href="<?php echo e(route('Auth.login')); ?>">Have Account?</a>
                            </div>
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

    <?php echo $__env->make('Auth.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    </div>

    <script src="assets/Client/js/jquery-3.3.1.min.js"></script>
    <script src="assets/Client/js/popper.min.js"></script>
    <script src="assets/Client/js/bootstrap.min.js"></script>
    <script src="assets/Client/js/owl.carousel.min.js"></script>
    <script src="assets/Client/js/jquery.sticky.js"></script>
    <script src="assets/Client/js/jquery.waypoints.min.js"></script>
    <script src="assets/Client/js/jquery.animateNumber.min.js"></script>
    <script src="assets/Client/js/jquery.fancybox.min.js"></script>
    <script src="assets/Client/js/jquery.easing.1.3.js"></script>
    <script src="assets/Client/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/Client/js/aos.js"></script>

    <script src="assets/Client/js/main.js"></script>

  </body>

</html>

<?php /**PATH C:\Users\YouCode\Documents\Mes Projets\Location_Hakimi\resources\views/Auth/register.blade.php ENDPATH**/ ?>