<!DOCTYPE html>
<html lang="en">
  <head>
    <title>My Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <?php echo $__env->make('Client.layout.style-link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
  </head>
  <body>


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
      
    </style>
    
    <?php echo $__env->make('Client.layout.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('<?php echo e(asset('assets/client/images/bg_3.jpg')); ?>');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Contact <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">My Profile</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">



      <div class="container">

        <img id="btn_edit" src="https://cdn-icons-png.flaticon.com/512/5996/5996831.png" alt="Edit Profile">
        <img id="btn_close" src="https://icons.veryicon.com/png/o/miscellaneous/all-blue-icon/close-428.png" alt="Cancel Edit">


        

        <div class="row">

          <div class="col-md-12">

            <div  style="display: flex ; justify-content: center; padding-bottom: 2em; padding-top: 2em;"  class="bg-light">
              
               <form id="photoForm" method="post" enctype="multipart/form-data" action="/changephotouser/<?php echo e($user[0]->client->id); ?>">
                        <?php echo csrf_field(); ?>
                        <label for="fileToUpload">
                            <div class="profile-pic" style="background-image: url('<?php echo e(asset($user[0]->client->image)); ?>')">
                                <span class="glyphicon glyphicon-camera"></span>
                                <?php if($user[0]->client->accepte == 1): ?>
                                <img src="<?php echo e(asset('images/verify.png')); ?>" id="verifyimg" title="Ce Compte a été vérifié par les responsables">
                              <?php endif; ?>
                                <span><i class="fas fa-image"></i></span>
                            </div>
                        </label>
                        <input type="file" name="image" id="fileToUpload">
                    </form>
            </div>

            <div class="user-info p-4 bg-light rounded" >
              <form id="photoForm" method="post" enctype="multipart/form-data" action="/updateinfouser">

                <?php echo csrf_field(); ?>
                <input type="hidden" name="user_id" value="<?php echo e($user[0]->client->id); ?>">
                <input type="hidden" name="id" value="<?php echo e($user[0]->id); ?>">
                <div class="mb-3">
                  <label for="cin" class="form-label">CIN</label>
                  <input type="text" id="cin" name="cin" class="form-control" value="<?php echo e($user[0]->client->cin); ?>" readonly>
                </div>
                
                <div class="mb-3">
                  <label for="nom" class="form-label">Nom</label>
                  <input type="text" id="nom" name="nom" class="form-control" value="<?php echo e($user[0]->client->nom); ?>" readonly>
                </div>
  
                <div class="mb-3">
                  <label for="prenom" class="form-label">Prénom</label>
                  <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo e($user[0]->client->prenom); ?>" readonly>
                </div>
  
              
  
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo e($user[0]->client->phone); ?>"  readonly>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="<?php echo e($user[0]->email); ?>" readonly>
                </div>
  
                <div class="mb-3">
                  <label for="myTextarea" class="form-label">Adresse</label>
                  <textarea id="myTextarea" name="adresse" class="form-control" rows="3" readonly><?php echo e($user[0]->client->adresse); ?></textarea>
                </div>
                
                <div class="mb-3" id="permis_input" style="display: none;">
                  <label for="adresse" class="form-label">Permis de conduire</label>
                  <div class="row">
                      <div class="form-group col-md-6">
                          <input type="file" name="permi" id="permi-recto" class="input-file">
                          <label for="permi-recto" class="btn btn-tertiary js-labelFile">
                              <i class="icon fa fa-check"></i>
                              <span class="js-fileName">Permi Recto</span>
                          </label>
                      </div>
                      <div class="form-group col-md-6">
                          <input type="file" name="v_permi" id="v-permi-verso" class="input-file">
                          <label for="v-permi-verso" class="btn btn-tertiary js-labelFile">
                              <i class="icon fa fa-check"></i>
                              <span class="js-fileName">Permi Verso</span>
                          </label>
                      </div>
                  </div>
              </div>
              <div class="mb-3" id="permis_images">
                <label for="adresse" class="form-label">Permis de conduire</label>
                <?php if($user[0]->client->permi != null): ?>
                <div class="row">
                    <div class="form-group col-md-6">
                        <img id="permi-recto-preview" src="<?php echo e(asset($user[0]->client->permi)); ?>" alt="Permi Recto Preview" style="width: 100%">
                    </div>
                    <div class="form-group col-md-6">
                        <img id="v-permi-verso-preview" src="<?php echo e(asset($user[0]->client->v_permi)); ?>" alt="Permi Verso Preview" style="width: 100%">
                    </div>
                </div>
                <?php endif; ?>
            </div>        


                <div class="mb-3">
                
                  <input type="submit"  value="Save" id="savebtn" class="form-control bg-primary" style="color: white !important ;  display: none" value="<?php echo e($user[0]->client->phone); ?>" >
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
	

    <?php echo $__env->make('Client.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <?php echo $__env->make('Client.layout.js-link', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <script>
      document.getElementById('fileToUpload').addEventListener('change', function(event) {
            document.getElementById('photoForm').submit(); 
        });

        document.getElementById('btn_edit').addEventListener('click', function(){
        document.getElementById('permis_input').style.display = 'block';
        document.getElementById('permis_images').style.display = 'none';
        document.getElementById('btn_edit').style.display = 'none';
        document.getElementById('btn_close').style.display = 'block';
        document.getElementById('savebtn').style.display = 'block'
        
        var inputs = document.querySelectorAll('input');
        inputs.forEach(function(input) {
            input.removeAttribute('readonly');
        });
    
       document.getElementById('myTextarea').removeAttribute('readonly');
       alert('You can now Edit your information')

    });

    document.getElementById('btn_close').addEventListener('click', function(){
    document.getElementById('permis_input').style.display = 'none';
    document.getElementById('permis_images').style.display = 'block';
    document.getElementById('btn_edit').style.display = 'block';
    document.getElementById('btn_close').style.display = 'none';
    document.getElementById('savebtn').style.display = 'none'

    
    var inputs = document.querySelectorAll('input');  
    inputs.forEach(function(input) {
        input.setAttribute('readonly', 'true');
    });
    
    document.getElementById('myTextarea').setAttribute('readonly', 'true');
    
    });
</script>
  </body>
</html><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/Client/profile.blade.php ENDPATH**/ ?>