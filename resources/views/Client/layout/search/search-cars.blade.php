@forelse($cars as $car)
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
@empty
<div id="carimage">
	<img src="{{asset('images/carsad.png')}}" alt="">
	<br>
	<h3>CARS NOT FOUND</h3>
</div>

@endforelse
          

<style>
	#carimage{
        width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
		background-color: white
	}
	#carimage img{
		width: 50%;

	}

</style>