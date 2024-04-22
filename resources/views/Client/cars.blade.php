<!DOCTYPE html>
<html lang="en">
  <head>
    <title>My Car</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    @include('Client.layout.style-link')
   
  </head>
  <body>


    <style>
      #search{
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 2em;
        
      }
      #search form{
        width: 80%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        flex-direction: row;
        gap: 1em;
      }
      

      #search form input{
        outline: none;
      }


      @media(max-width:800px){
        #search form{
        width: 80%;
        display: grid;
        grid-template-columns: 1fr;
        flex-direction: column;
        gap: 1em;
      }
      }

      .ftco-animate{
        visibility: visible;
        opacity: 1;
      }
    </style>
    
	@include('Client.layout.nav')

    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{asset('assets/client/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
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
    <h1 class="mb-3 bread" style="text-align: center ; margin-top: 1em;">Saerch  </h1>
		
    <div id="search">
      <form action="" id="searchForm" onchange="performSearch">
        <select class="form-control" id="car_mark"  name="marque_id" required>
          <option value="" selected disabled>Select Marque</option>
          @foreach ($cars as $car)              
            <option value="{{$car->marque->id}}">{{$car->marque->name}}</option> 
          @endforeach

        </select>
        <select class="form-control" id="car_model" name="car_model" required>
          <option value="" selected disabled>Select Model</option>
        </select>

        <input class="form-control" type="datetime-local" id="startDateInput" name="date_start" required>
        <input class="form-control" type="datetime-local" id="startDateInput" name="date_end" required><br>
     </form>
    </div>

		<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row" id="searchResults">

          @foreach($cars as $car)
          <div class="col-md-4">
    				<div class="car-wrap rounded ftco-animate">
    					<div class="img rounded d-flex align-items-end" style="background-image: url({{asset('images/cars/'.$car->image)}});">
    					</div>
    					<div class="text">
    						<h2 class="mb-0"><a href="/car_single/{{$car->id}}">{{$car->marque->name}}</a></h2>
    						<div class="d-flex mb-3">
	    						<span style="color: rgb(132, 132, 132)">{{$car->model->name}}</span>
	    						<p class="price ml-auto">DH {{$car->prix_par_jour}} <span>/day</span></p>
    						</div>
    						<p class="d-flex mb-0 d-block"><a href="/car_single/{{$car->id}}" class="btn btn-primary py-2 mr-1">Book now</a> <a href="/car_single/{{$car->id}}" class="btn btn-secondary py-2 ml-1">Details</a></p>
    					</div>
    				</div>
    			</div>
          @endforeach
          
    		</div>
    		<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                @if ($cars->lastPage() > 1)
                    <li><a href="{{ $cars->url(1) }}">&lt;</a></li>
                    @for ($i = 1; $i <= min(5, $cars->lastPage()); $i++)
                        <li class="{{ $i == $cars->currentPage() ? 'active' : '' }}"><a href="{{ $cars->url($i) }}">{{ $i }}</a></li>
                    @endfor
                    @if ($cars->lastPage() > 5)
                        <li><span>...</span></li>
                        <li><a href="{{ $cars->url($cars->lastPage()) }}">{{ $cars->lastPage() }}</a></li>
                    @endif
                    <li><a href="{{ $cars->url($cars->currentPage() + 1) }}">&gt;</a></li>
                @endif
            </ul>
            
            
            </div>
          </div>
        </div>
    	</div>
    </section>
    <meta name="csrf-token" content="{{ csrf_token() }}">


	@include('Client.layout.footer')

  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  @include('Client.layout.js-link')


  <script>
    
    $(document).ready(function(){
    $('#searchForm').find('input, select').change(function() {
        performSearch();
    });

    function performSearch() {
        var formData = $('#searchForm').serialize();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: '/search/cars/client/ajax',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response){
                console.log(response);
                $('#searchResults').html(response);
            },
            error: function(xhr, status, error){
                console.error(error);
            }
        });
    }
});



  </script>


<script>
  $(document).ready(function() {
      $('#car_mark').change(function() {
          var marqueId = $(this).val();
          $.ajax({
              url: '/cars/searchByMark/' + marqueId,
              type: 'GET',
              success: function(response) {
                  $('#car_model').empty();
                  $.each(response.data, function(key, value) {
                      $('#car_model').append('<option style="background-color: #1089ff !important; color: white" value="' + value.id + '">' + value.name + '</option>');
                  });
              }
          });
      });
  });

</script>
    
  </body>
</html>