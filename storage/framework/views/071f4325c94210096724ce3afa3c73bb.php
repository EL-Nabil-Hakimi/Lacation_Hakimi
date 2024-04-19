<!DOCTYPE html>
<html lang="en">
  <head>
    <title>My Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php echo $__env->make('Client.layout.style-link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
  </head>
  <body>
    
	<?php echo $__env->make('Client.layout.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('assets/client/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Choose Your Car</h1>
          </div>
        </div>
      </div>
    </section>
		

		<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">

          <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-4">
    				<div class="car-wrap rounded ftco-animate">
    					<div class="img rounded d-flex align-items-end" style="background-image: url(<?php echo e(asset('images/cars/'.$car->image)); ?>);">
    					</div>
    					<div class="text">
    						<h2 class="mb-0"><a href="/car_single/<?php echo e($car->id); ?>"><?php echo e($car->marque->name); ?></a></h2>
    						<div class="d-flex mb-3">
	    						<span style="color: rgb(132, 132, 132)"><?php echo e($car->model->name); ?></span>
	    						<p class="price ml-auto">DH <?php echo e($car->prix_par_jour); ?> <span>/day</span></p>
    						</div>
    						<p class="d-flex mb-0 d-block"><a href="/car_single/<?php echo e($car->id); ?>" class="btn btn-primary py-2 mr-1">Book now</a> <a href="/car_single/<?php echo e($car->id); ?>" class="btn btn-secondary py-2 ml-1">Details</a></p>
    					</div>
    				</div>
    			</div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <?php if($cars->lastPage() > 1): ?>
                    <li><a href="<?php echo e($cars->url(1)); ?>">&lt;</a></li>
                    <?php for($i = 1; $i <= min(5, $cars->lastPage()); $i++): ?>
                        <li class="<?php echo e($i == $cars->currentPage() ? 'active' : ''); ?>"><a href="<?php echo e($cars->url($i)); ?>"><?php echo e($i); ?></a></li>
                    <?php endfor; ?>
                    <?php if($cars->lastPage() > 5): ?>
                        <li><span>...</span></li>
                        <li><a href="<?php echo e($cars->url($cars->lastPage())); ?>"><?php echo e($cars->lastPage()); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo e($cars->url($cars->currentPage() + 1)); ?>">&gt;</a></li>
                <?php endif; ?>
            </ul>
            
            
            </div>
          </div>
        </div>
    	</div>
    </section>
    

	<?php echo $__env->make('Client.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <?php echo $__env->make('Client.layout.js-link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
  </body>
</html><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/Client/cars.blade.php ENDPATH**/ ?>