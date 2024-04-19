<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php if(session()->has('success')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo e(session("success")); ?>',
                showConfirmButton: false,
                timer: 3000 
            }); 
        });
    </script>
    <?php elseif(session()->has('error')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'error!',
                text: '<?php echo e(session("error")); ?>',
                showConfirmButton: false,
                timer: 3000 
            }); 
        });
    </script>

    <?php endif; ?>

    <?php if($errors->any()): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: '<ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>',
                showConfirmButton: false,
                timer: 5000 
            });
        });
    </script>
<?php endif; ?>


<?php if($errors->any() || session()->has('error')): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let errorMessage = '';
            <?php if($errors->any()): ?>
                errorMessage += '<ul>';
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    let errorMessageWithoutAsterisk = '<?php echo e($error); ?>'.replace(/^\*/, '');
                    errorMessage += '<p>' + errorMessageWithoutAsterisk + '</p>';
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                errorMessage += '</ul>';
            <?php endif; ?>

            <?php if(session()->has('error')): ?>
                errorMessage += '<p><?php echo e(session("error")); ?></p>';
            <?php endif; ?>

            Swal.fire({
                icon: 'error',
                title: 'Error!',
                html: errorMessage,
                showConfirmButton: false,
                timer: 5000 
            });
        });
    </script>
<?php endif; ?>



    <meta charset="utf-8">
    <title>My Car</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    

    <!-- Favicon -->
    <link href="<?php echo e(asset('assets/admin/img/favicon.ico')); ?>" rel="icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-sqntGU3CTEVGj2Og5kwYPqjPyRX1vIBR7zmV6BZ9LlT3Cv9Fdm/Bt0BUgaQD/nmydxvzJR4x53kHvNuX1i0Awg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="<?php echo e(asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css')); ?>" rel ="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="<?php echo e(asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css')); ?>" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo e(asset('assets/admin/lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')); ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo e(asset('assets/admin/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo e(asset('assets/admin/css/style.css')); ?>" rel="stylesheet">
    
</head>

<body >

    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>My Car</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo e(asset(session()->get('user_image'))); ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">

                        <h6 class="mb-0"><?php echo e(session()->get('user_name')); ?></h6>
                        
                        <span><?php echo e(session()->get('role_name')); ?></span>

                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <?php if(session()->get('role_id') == 1): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('admin.dashboard') ? ' active' : ''); ?>"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
                    <a href="<?php echo e(route('admin.managers')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('admin.managers') ? ' active' : ''); ?>"><i class="fas fa-users me-2"></i>Managers</a>
                    <a href="<?php echo e(route('admin.clients')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('admin.clients') ? ' active' : ''); ?>"><i class="fas fa-user-friends me-2"></i>Clients</a>
                    <a href="<?php echo e(route('admin.voitures')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('admin.voitures') ? ' active' : ''); ?>"><i class="fas fa-car me-2"></i>Voitures</a>
                    <a href="<?php echo e(route('admin.reservation')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('module.reservation') ? ' active' : ''); ?>"><i class="fas fa-calendar-check me-2"></i>Reservations</a>
                    <a href="<?php echo e(route('marque.cars')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('marque.cars') ? ' active' : ''); ?>"><i class="fas fa-tag me-2"></i>Marque</a>
                    <a href="<?php echo e(route('module.cars')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('module.cars') ? ' active' : ''); ?>"><i class="fas fa-puzzle-piece me-2"></i>Module</a>
                    
                    <?php else: ?>
                    <a href="<?php echo e(route('manager.dashboard')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('manager.dashboard') ? ' active' : ''); ?>"><i class="fas fa-chart-line me-2"></i>Dashboard</a>
                    <a href="<?php echo e(route('manager.clients')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('manager.clients') ? ' active' : ''); ?>"><i class="fas fa-user-friends me-2"></i>Clients</a>
                    <a href="<?php echo e(route('manager.cars')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('manager.cars') ? ' active' : ''); ?>"><i class="fas fa-car me-2"></i>Voitures</a>
                    <a href="<?php echo e(route('marque.cars')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('marque.cars') ? ' active' : ''); ?>"><i class="fas fa-tag me-2"></i>Marque</a>
                    <a href="<?php echo e(route('module.cars')); ?>" class="nav-item nav-link<?php echo e(request()->routeIs('module.cars') ? ' active' : ''); ?>"><i class="fas fa-puzzle-piece me-2"></i>Module</a>

                    
                    <?php endif; ?>            
                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">

            

            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="<?php echo e(asset('assets/admin/img/user.jpg')); ?>" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="<?php echo e(asset('assets/admin/img/user.jpg')); ?>" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="<?php echo e(asset('assets/admin/img/user.jpg')); ?>" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo e(asset(session()->get('user_image'))); ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo e(session()->get('user_name') ?? ''); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <?php if(session()->get('role_id') != 1): ?>
                            <a href="/manager/myprofile/<?php echo e(session()->get('user_id', '')); ?>" class="dropdown-item">My Profile</a>
                            <?php endif; ?>
                            <a href="/logout" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <?php echo $__env->yieldContent('content'); ?>

            <!-- Sale & Revenue Start -->
            
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
      
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            
            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            
            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Location Hakimi</a>, All Right Reserved. 
                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="<?php echo e(asset('https://code.jquery.com/jquery-3.4.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/chart/chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/lib/easing/easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/lib/waypoints/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/lib/owlcarousel/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/lib/tempusdominus/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/lib/tempusdominus/js/moment-timezone.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo e(asset('assets/admin/js/main.js')); ?>"></script>
    <!-- Add this in your HTML file, preferably in the <head> section -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/admin/index.blade.php ENDPATH**/ ?>