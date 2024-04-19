
<?php $__env->startSection('content'); ?>
<style>

  .profile-pic {
       border-radius: 50%;
      
       background-size: cover;
       background-position: center;
       background-blend-mode: multiply;
       vertical-align: middle;
       text-align: center;
       color: transparent;
       transition: all .3s ease;
       text-decoration: none;
       cursor: pointer;
       position: relative;
       width: 150px; 
       height: 150px;
       
     }

   .profile-pic:hover {
       background-color: rgba(0, 0, 0, .5);
       z-index: 10000;
       color: #fff;
       display: flex;
       align-items: center;
       justify-content: center;
       transition: all .3s ease;
       text-decoration: none;

   }

   .profile-pic span {
       display: inline-block;
       padding-top: 4.5em;
       padding-bottom: 4.5em;
   }

   form input[type="file"] {
       display: none;
       cursor: pointer;
   }

   .btn-tertiary {
       color: #555;
       padding: 0;
       line-height: 40px;
       width: 300px;
       margin: auto;
       display: block;
       border: 2px solid #555;
   }

   .btn-tertiary:hover, 
   .btn-tertiary:focus {
       color: lighten(#555, 20%);
       border-color: lighten(#555, 20%);
   }

   
   #verifyimg {
           position: absolute;
           width: 40px;
           height: 40px;
           top:-2px; 
           left: 0px;
       }

   .inputy {
       display: none !important;
   }

  #btn_edit , #btn_close{
      width: 3em;
      height: 3em;
      right: 1em;
      position: fixed;
      top: 20%;
      opacity: 0.7;
      cursor: pointer;
      transition: 0.6s;
      z-index: 99999999;
  }

  #btn_edit:hover , #btn_close:hover{
       opacity: 1;
  }

  #btn_close{
     display: none;
  }

  .pagination {
    list-style: none;
    padding: 0;
    margin: 20px 0;
    text-align: center;
  }

  .pagination li {
      display: inline-block;
      margin: 0 5px;
  }

  .pagination li.active a {
      background-color: #007bff;
      color: #fff;
      border-radius: 5px;
      padding: 5px 10px;
  }

  .pagination li a {
      color: #007bff;
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #007bff;
      border-radius: 5px;
  }

  .pagination li a:hover {
      background-color: #007bff;
      color: #fff;
  }
 
  #verifyimg{
    width: 20px;
    height: 20px;
    position: absolute;
    top: -.2em;
    left: -.6em;
  }


  #idreservation{
    z-index: 999999999999;
    background-color: #1078e7;
    padding: .3em;
    
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    left: -1.5em; 
    top: -.8em;
    font-weight: bold;  
  }
</style>

<section class="ftco-section contact-section ">


  <div class="container">

    <div class="container mt-5 mb-5" >
      <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="d-flex justify-content-center row mt-3" >
        
        <div class="col-md-10" style="box-shadow: 0px 0px 5px 1px ; padding :1em;" >
          <p id="idreservation"><?php echo e($res->id); ?></p>
          <td >
            <div class="d-flex align-items-center" style="position: relative ; margin-bottom:0.5em ; margin-left: 1em" >
              <?php if($res->user->client->accepte == 1): ?>
                 <img src="<?php echo e(asset('images/verify.png')); ?>" id="verifyimg" title="Ce Compte a été vérifié par les responsables">
              <?php endif; ?>
  
              <img
                 src="<?php echo e(asset($res->user->client->image)); ?>"
                  alt=""  
                  style="width: 45px; height: 45px"
                  class="rounded-circle"
                  />
              <div class="ms-3">
                <a href="/profileusershow/<?php echo e($res->user->id); ?>"><p class="fw-bold mb-1"><?php echo e($res->user->name); ?></p> </a>
                <p class="text-muted mb-0"><?php echo e($res->user->email); ?></p>
              </div>
            </div>
          </td>
            <div class="row p-2 bg-white" style="align-items: center">
                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="<?php echo e(asset('images/cars/'.$res->car->image )); ?>"></div>
                <div class="col-md-6 mt-1">
                    <h5><?php echo e($res->car->marque->name); ?> <h6 style="color: #555"><?php echo e($res->car->model->name); ?></h6></h5>
                    
                    <div class="d-flex flex-row">
                    </div>
                    <div class="mt-1 mb-1 spec-1" style="color: rgb(57, 57, 57)">
                      <span>Start: <?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $res->date_debut)->format('Y-m-d H:i')); ?><br></span>
                  </div>
                  <div class="mt-1 mb-1 spec-1" style="color: rgb(57, 57, 57)">
                      <span>End: <?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $res->date_fin)->format('Y-m-d H:i')); ?><br></span>
                  </div>
                 
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1"> DH <?php echo e($res->car->prix_par_jour); ?>/Jour</h4>
                    </div>
                    <?php if($res->accepte === 1): ?>
                    <h6 class="text-success">Status: Accepted</h6>
                    <?php elseif($res->accepte === 2): ?>
                    <h6 class="text-danger">Status: Rejected</h6>
                    <?php elseif($res->accepte === 3): ?>
                    <h6 class="text-warning">Status: Car is out</h6>
                    <?php elseif($res->accepte === 4): ?>
                    <h6 class="text-secondary">Status: Ended</h6>
                    <?php else: ?>
                    <h6 class="text-primary">Status: Pending</h6>
                    <?php endif; ?>


                    <div class="d-flex flex-column mt-4">
                      <?php if($res->accepte == null): ?>
                          <button class="btn btn-outline-success btn-sm" type="button" onclick="AlertCan(<?php echo e($res->id); ?>  , '1', 'You want to accept this reservation !')">
                            <i class="fas fa-times"></i> Accept
                          </button>
                            <button class="btn btn-outline-danger btn-sm mt-2" type="button" onclick="AlertCan(<?php echo e($res->id); ?>  , '2','You want to reject this car.')">
                            <i class="fas fa-times"></i> Reject
                          </button>  
                      <?php elseif($res->accepte == 1 || $res->accepte == 3): ?>   
                      <?php if($res->accepte != 1): ?>       
                            <button class="btn btn-outline-success btn-sm" type="button" onclick="AlertCan(<?php echo e($res->id); ?>  , '4', 'You confirm this car is received!')">
                            <i class="fas fa-times"></i> Rceived
                          </button>
                      <?php endif; ?>
                      <?php if($res->accepte != 3): ?>
                          <button class="btn btn-outline-warning btn-sm mt-2" type="button" onclick="AlertCan(<?php echo e($res->id); ?>  , '3', 'You want to set this car out !')">
                            <i class="fas fa-times"></i> Car is out
                          </button>
                      <?php endif; ?>
                      <?php endif; ?>

                    </div>
                    </div>
                  
            </div>
           
        </div>

        
    </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="alert alert-danger" role="alert">
              You have no reservations </div>
      <?php endif; ?>

<div style="display: flex; justify-content: center">
      <ul class="pagination">
        <?php if($reservations->lastPage() > 1): ?>
            <li><a href="<?php echo e($reservations->url(1)); ?>">&lt;</a></li>
            <?php for($i = 1; $i <= min(5, $reservations->lastPage()); $i++): ?>
                <li class="<?php echo e($i == $reservations->currentPage() ? 'active' : ''); ?>"><a href="<?php echo e($reservations->url($i)); ?>"><?php echo e($i); ?></a></li>
            <?php endfor; ?>
            <?php if($reservations->lastPage() > 5): ?>
                <li><span>...</span></li>
                <li><a href="<?php echo e($reservations->url($reservations->lastPage())); ?>"><?php echo e($reservations->lastPage()); ?></a></li>
            <?php endif; ?>
            <li><a href="<?php echo e($reservations->url($reservations->currentPage() + 1)); ?>">&gt;</a></li>
        <?php endif; ?>
    </ul>

  </div>

  </div>
  </div>


  <script>
    function AlertCant(message) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message
      });
    }
    

    function downloadReservation() {
      Swal.fire({
        icon: 'success',
        title: 'Downloaded',
        text: 'Your reservation has been downloaded successfully'
      });
    }

    function AlertCan(id , status ,message) {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: message,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/admin/StatuCar/"+id+"/"+status;
        }
      });
    }
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/admin/layout/reservation.blade.php ENDPATH**/ ?>