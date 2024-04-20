

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" >
    <div class="container">
      <a class="navbar-brand" href="/">My<span>Car</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ request()->routeIs('Client.index') ? ' active' : '' }}">
                <a href="{{ route('Client.index') }}" class="nav-item nav-link">Home</a>
            </li>
            <li class="nav-item {{ request()->routeIs('Client.cars') ? ' active' : '' }}">
                <a href="{{ route('Client.cars') }}" class="nav-item nav-link">Cars</a>
            </li>
            <li class="nav-item {{ request()->routeIs('Client.blog') ? ' active' : '' }}">
                <a href="{{ route('Client.blog') }}" class="nav-item nav-link">Blogs</a>
            </li>
            <li class="nav-item {{ request()->routeIs('Client.services') ? ' active' : '' }}">
                <a href="{{ route('Client.services') }}" class="nav-item nav-link">Services</a>
            </li>
            <li class="nav-item {{ request()->routeIs('Client.about') ? ' active' : '' }}">
                <a href="{{ route('Client.about') }}" class="nav-item nav-link">About</a>
            </li>
            <li class="nav-item {{ request()->routeIs('Client.contact') ? ' active' : '' }}">
                <a href="{{ route('Client.contact') }}" class="nav-item nav-link">Contact</a>
            </li>

            @if(session()->has('user_id') && session()->get('role_id') == 3)
            <a href="/Client/reservations" id="reservation_btn"title="Show my reservations">My Reservations</a>

            <li class="nav-item">
              <a href="/profile/{{ $user[0]->id }}" class="nav-item nav-link">
                  <img src="{{asset($user[0]->client->image)}}" id="photoprofile"
                  alt="Profile Image" class="img-fluid">
                  @if($user[0]->client->nom == null)
                     Edit your Profile
                  @else
                    {{$user[0]->client->nom}}
                    {{$user[0]->client->prenom}}
                  @endif
              </a>
          </li>

          <li class="nav-item ">
            <a href="/logout" class="nav-item nav-link">Logout</a>
        </li>
            @else
            <li class="nav-item ">
              <a href="/login" class="nav-item nav-link">Login/Register</a>
          </li>
            @endif
        </ul>
    </div>
    
    </div>


    @if(session()->has('user_id') && session()->get('role_id') == 3)
            <a href="/Client/reservations" id="reservation_btn"title="Show my reservations">My Reservations</a>
    @endif

  </nav>



  @if(session()->has('success'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              icon: 'success',
              title: 'Success!',
              text: '{{ session("success") }}',
              showConfirmButton: false,
              timer: 3000 
          }); 
      });
  </script>
  @elseif(session()->has('error'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              icon: 'error',
              title: 'error!',
              text: '{{ session("error") }}',
              showConfirmButton: false,
              timer: 3000 
          }); 
      });
  </script>

  @endif

  @if ($errors->any())
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
              icon: 'error',
              title: 'Validation Error!',
              html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
              showConfirmButton: false,
              timer: 5000 
          });
      });
  </script>
@endif


@if ($errors->any() || session()->has('error'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          let errorMessage = '';
          @if ($errors->any())
              errorMessage += '<ul>';
              @foreach ($errors->all() as $error)
                  let errorMessageWithoutAsterisk = '{{ $error }}'.replace(/^\*/, '');
                  errorMessage += '<p>' + errorMessageWithoutAsterisk + '</p>';
              @endforeach
              errorMessage += '</ul>';
          @endif

          @if(session()->has('error'))
              errorMessage += '<p>{{ session("error") }}</p>';
          @endif

          Swal.fire({
              icon: 'error',
              title: 'Error!',
              html: errorMessage,
              showConfirmButton: false,
              timer: 5000 
          });
      });

  </script>
@endif

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

    #photoprofile{
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
            width: 2.2em; 
            height: 2.2em;
    }

</style>