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
    
    @include('Client.layout.nav')

    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{asset('assets/client/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
            <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Reservation <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">My Reservations</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">

      <div style="display: flex ;justify-content: center"><h1><span style="color: rgb(63, 63, 208) ;  ">My Car</span>  is always in your service</h1></div>

      <div class="container">

        <div class="container mt-5 mb-5">
          @forelse ($reservations as $res)
          <div class="d-flex justify-content-center row mt-2" >
            <div class="col-md-10" style="box-shadow: 0px 0px 5px 1px">
                <div class="row p-2 bg-white border rounded" style="align-items: center">
                    <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="{{asset('images/cars/'.$res->car->image )}}"></div>
                    <div class="col-md-6 mt-1">
                        <h5>{{$res->car->marque->name}} <h6>{{$res->car->model->name}}</h6></h5>
                        
                        <div class="d-flex flex-row">
                        </div>
                        <div class="mt-1 mb-1 spec-1" style="color: rgb(57, 57, 57)">
                          <span>Start: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $res->date_debut)->format('Y-m-d H:i') }}<br></span>
                      </div>
                      <div class="mt-1 mb-1 spec-1" style="color: rgb(57, 57, 57)">
                          <span>End: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $res->date_fin)->format('Y-m-d H:i') }}<br></span>
                      </div>
                      
                    </div>
                    <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                        <div class="d-flex flex-row align-items-center">
                            <h4 class="mr-1"> DH {{$res->car->prix_par_jour}}/Jour</h4>
                        </div>
                        @if($res->accepte === 1)
                        <h6 class="text-success">Status: Accepted</h6>
                        @elseif($res->accepte === 2)
                        <h6 class="text-danger">Status: Rejected</h6>
                        @elseif($res->accepte === 3)
                        <h6 class="text-warning">Status: Car is out</h6>
                        @elseif($res->accepte === 4)
                        <h6 class="text-secoundary">Status: Ended</h6>
                        @elseif($res->accepte === 5)
                        <h6 class="text-danger">Status: Canceld</h6>
                        @else
                        <h6 class="text-primary">Status: Pending</h6>
                        @endif


                        <div class="d-flex flex-column mt-4">
                          @if($res->accepte == null)
                          <button class="btn btn-danger btn-sm" type="button" onclick="AlertCan( '{{$res->id}}' ,'5','If this reservation is canceled, you can\'t cancel it again.')">
                            <i class="fas fa-times"></i> Cancel
                          </button>
                          @elseif($res->accepte == 1 || $res->accepte == 2)
                          <button class="btn btn-danger btn-sm" type="button" onclick="AlertCant('This reservation cannot be canceled.')">
                            <i class="fas fa-times"></i> Cancel
                          </button>
                          @elseif($res->accepte == 3 || $res->accepte == 4)
                          <button class="btn btn-danger btn-sm" type="button" onclick="AlertCant('You can\'t cancel this reservation.')">
                            <i class="fas fa-times"></i> Cancel
                          </button>
                          @elseif($res->accepte == -1)
                          <button class="btn btn-danger btn-sm" type="button" onclick="AlertCant('This reservation has been rejected')">
                            <i class="fas fa-times"></i> Cancel
                          </button>
                          @endif

                          @if($res->accepte == null)
                          <button class="btn btn-outline-primary btn-sm mt-2"  type="button" onclick="AlertCant('Reservations cannot be downloaded until they are accepted.')">
                            <i class="fas fa-download"></i> Download
                          </button>
                          @elseif($res->accepte == 1)
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button" onclick="downloadReservation({{$res->id}})">
                              <i class="fas fa-download"></i> Download
                            </button>
                          @elseif($res->accepte == 2)
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button" onclick="AlertCant('This reservation has been rejected')">
                              <i class="fas fa-download"></i> Download
                            </button>
                          @elseif($res->accepte == 3)
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button" onclick="downloadReservation({{$res->id}})">
                              <i class="fas fa-download"></i> Download
                            </button>
                          @elseif($res->accepte == 4)
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button" onclick="downloadReservation({{$res->id}})">
                              <i class="fas fa-download"></i> Download
                            </button>
                          @elseif($res->accepte == -1)
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button" disabled onclick="AlertCant('Reservations cannot be downloaded if they are rejected')">
                              <i class="fas fa-download"></i> Download
                            </button>
                          @endif
                        </div>
                        </div>
                      
                </div>
               
            </div>
        </div>
          @empty
              <div class="alert alert-danger" role="alert">
                  You have no reservations </div>
          @endforelse
          
      </div>
      </div>
    </section>
	
    <div class="row mt-5 mb-5">
      <div class="col text-center">
        <div class="block-27">
          <ul>
            @if ($reservations->lastPage() > 1)
                <li><a href="{{ $reservations->url(1) }}">&lt;</a></li>
                @for ($i = 1; $i <= min(5, $reservations->lastPage()); $i++)
                    <li class="{{ $i == $reservations->currentPage() ? 'active' : '' }}"><a href="{{ $reservations->url($i) }}">{{ $i }}</a></li>
                @endfor
                @if ($reservations->lastPage() > 5)
                    <li><span>...</span></li>
                    <li><a href="{{ $reservations->url($reservations->lastPage()) }}">{{ $reservations->lastPage() }}</a></li>
                @endif
                <li><a href="{{ $reservations->url($reservations->currentPage() + 1) }}">&gt;</a></li>
            @endif
        </ul>
        
        
        </div>
      </div>
    </div>
    @include('Client.layout.footer')

    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  @include('Client.layout.js-link')


  <script>
    function AlertCant(message) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message
      });
    }
    

   function downloadReservation(id) {
    Swal.fire({
        title: 'Confirm Download',
        text: 'Are you sure you want to download your reservation?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, download it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Downloaded',
                text: 'Your reservation has been downloaded successfully'
            });
            window.location.href= '/client/downloadReservation/'+id;
        }
    });
}




    function AlertCan(id, status,message) {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: message,
      showCancelButton: true,
      confirmButtonText: 'Confirm',
      cancelButtonText: 'Cancel',
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '/client/StatuCar/' + id+'/' + status;
        }
      });
    }

  </script>
  </script>
  </body>
</html>