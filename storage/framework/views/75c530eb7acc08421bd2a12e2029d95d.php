

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" >
    <div class="container">
      <a class="navbar-brand" href="/">My<span>Car</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo e(request()->routeIs('Client.index') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('Client.index')); ?>" class="nav-item nav-link">Home</a>
            </li>
            <li class="nav-item <?php echo e(request()->routeIs('Client.cars') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('Client.cars')); ?>" class="nav-item nav-link">Cars</a>
            </li>
            <li class="nav-item <?php echo e(request()->routeIs('Client.blog') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('Client.blog')); ?>" class="nav-item nav-link">Blogs</a>
            </li>
            <li class="nav-item <?php echo e(request()->routeIs('Client.services') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('Client.services')); ?>" class="nav-item nav-link">Services</a>
            </li>
            <li class="nav-item <?php echo e(request()->routeIs('Client.about') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('Client.about')); ?>" class="nav-item nav-link">About</a>
            </li>
            <li class="nav-item <?php echo e(request()->routeIs('Client.contact') ? ' active' : ''); ?>">
                <a href="<?php echo e(route('Client.contact')); ?>" class="nav-item nav-link">Contact</a>
            </li>

            <?php if(session()->has('user_id') && session()->get('role_id') == 3): ?>
            <a href="/Client/reservations" id="reservation_btn"title="Show my reservations">My Reservations</a>

            <li class="nav-item">
              <a href="/profile/<?php echo e($user[0]->id); ?>" class="nav-item nav-link">
                  <img src="<?php echo e(asset($user[0]->client->image)); ?>"
                    style="width: 2em ;height: 2em; ; border-radius: 50%"
                  alt="Profile Image" class="img-fluid">
                  <?php if($user[0]->client->nom == null): ?>
                     Edit your Profile
                  <?php else: ?>
                    <?php echo e($user[0]->client->nom); ?>

                    <?php echo e($user[0]->client->prenom); ?>

                  <?php endif; ?>
              </a>
          </li>

          <li class="nav-item ">
            <a href="/logout" class="nav-item nav-link">Logout</a>
        </li>
            <?php else: ?>
            <li class="nav-item ">
              <a href="/login" class="nav-item nav-link">Login/Register</a>
          </li>
            <?php endif; ?>
        </ul>
    </div>
    
    </div>
  </nav>



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

<style>
    #reservation_btn{
        position: fixed;
        left: 0;
        z-index: 9999999999999999;
        width: 10em;
        height: 2em;
        background-color: #0d6efd !important;

        border-radius:0px 20px 20px 0px;
        top: 15%;   
        padding: 0.5em;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0.7;
    }

    #reservation_btn:hover{
        background-color: blue !important;
        color: white;
        transform: scale(1.1);
        opacity: 1;
        width: 15em;
        border-radius:0px 20px 20px 0px;
    }

</style><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/Client/layout/nav.blade.php ENDPATH**/ ?>