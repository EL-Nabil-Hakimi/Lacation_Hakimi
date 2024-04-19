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
            <h1 class="mb-3 bread">My Reservations</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">



      <div class="container">

        <div class="container mt-5 mb-5">
          <div class="d-flex justify-content-center row">
              <div class="col-md-10">
                  <div class="row p-2 bg-white border rounded">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="https://i.imgur.com/QpjAiHq.jpg"></div>
                      <div class="col-md-6 mt-1">
                          <h5>Quant olap shirts</h5>
                          <div class="d-flex flex-row">
                              <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                          </div>
                          <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light weight</span><span class="dot"></span><span>Best finish<br></span></div>
                          <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div>
                          <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                          <div class="d-flex flex-row align-items-center">
                              <h4 class="mr-1">$13.99</h4><span class="strike-text">$20.99</span>
                          </div>
                          <h6 class="text-success">Free shipping</h6>
                          <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button></div>
                      </div>
                  </div>
                  <div class="row p-2 bg-white border rounded mt-2">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="https://i.imgur.com/JvPeqEF.jpg"></div>
                      <div class="col-md-6 mt-1">
                          <h5>Quant trident shirts</h5>
                          <div class="d-flex flex-row">
                              <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>
                          </div>
                          <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light weight</span><span class="dot"></span><span>Best finish<br></span></div>
                          <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div>
                          <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                          <div class="d-flex flex-row align-items-center">
                              <h4 class="mr-1">$14.99</h4><span class="strike-text">$20.99</span>
                          </div>
                          <h6 class="text-success">Free shipping</h6>
                          <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button></div>
                      </div>
                  </div>
                  <div class="row p-2 bg-white border rounded mt-2">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="https://i.imgur.com/Bf4dIaN.jpg"></div>
                      <div class="col-md-6 mt-1">
                          <h5>Quant ruybi shirts</h5>
                          <div class="d-flex flex-row">
                              <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>123</span>
                          </div>
                          <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light weight</span><span class="dot"></span><span>Best finish<br></span></div>
                          <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div>
                          <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                          <div class="d-flex flex-row align-items-center">
                              <h4 class="mr-1">$13.99</h4><span class="strike-text">$20.99</span>
                          </div>
                          <h6 class="text-success">Free shipping</h6>
                          <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button></div>
                      </div>
                  </div>
                  <div class="row p-2 bg-white border rounded mt-2">
                      <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="https://i.imgur.com/HO8e9b8.jpg"></div>
                      <div class="col-md-6 mt-1">
                          <h5>Quant tinor shirts</h5>
                          <div class="d-flex flex-row">
                              <div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>110</span>
                          </div>
                          <div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light weight</span><span class="dot"></span><span>Best finish<br></span></div>
                          <div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div>
                          <p class="text-justify text-truncate para mb-0">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.<br><br></p>
                      </div>
                      <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                          <div class="d-flex flex-row align-items-center">
                              <h4 class="mr-1">$15.99</h4><span class="strike-text">$21.99</span>
                          </div>
                          <h6 class="text-success">Free shipping</h6>
                          <div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button class="btn btn-outline-primary btn-sm mt-2" type="button">Add to wishlist</button></div>
                      </div>
                  </div>
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
</html><?php /**PATH C:\Users\YouCode\Documents\Mes Projets\fileRouge\Location_Hakimi\resources\views/client/reservations.blade.php ENDPATH**/ ?>