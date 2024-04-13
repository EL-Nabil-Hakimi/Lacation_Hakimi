<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Carbook - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    @include('Client.layout.style-link')
   
  </head>
  <body>
    
	@include('Client.layout.nav')

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
    			<div class="col-md-4">
				@forelse ($cars as $car)
				<div class="car-wrap rounded ftco-animate">
					<div class="img rounded d-flex align-items-end" style="background-image: url({{asset('images/cars/'.$car->image)}});">
					</div>
					<div class="text">
						<h2 class="mb-0"><a href="car-single.html">{{$car->marque->name}}</a></h2>
						<div class="d-flex mb-3">
							<span class="cat" style="color: rgb(101, 101, 101)">{{$car->model->name}}</span>
							<p class="price ml-auto">${{$car->prix_par_jour}} <span>/day</span></p>
						</div>
						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book now</a> <a href="/car_single/{{$car->id}}" class="btn btn-secondary py-2 ml-1">Details</a></p>
					</div>	
				</div>
					@empty

					<div>
						<h1>Cars Not Fount</h1>
                    </div>
					</div>
						
					@endforelse
    			
    			</div>    			
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
    	</div>
    </section>
    

	@include('Client.layout.footer')

  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  @include('Client.layout.js-link')

    
  </body>
</html>