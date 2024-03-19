<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="assets/auth/style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body style="background-color: rgb(38, 130, 204)">

  <div class="container">

    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="back">
        <img src="assets/auth/images/frontImg.jpg" alt="">
        <div class="text">
			<span class="text-1">Explorez des kilomètres de voyage <br> avec une seule voiture</span>
			<span class="text-2">Commencez maintenant</span>

        </div>
      </div>
      <div class="front">
        <img class="backImg" src="assets/auth/images/backImg.jpg" alt="">
        <div class="text">
			<span class="text-1">Explorez des kilomètres de voyage <br> avec une seule voiture</span>
			<span class="text-2">Commencez maintenant</span>

        </div>
      </div>
    </div>	
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
			  <div style="text-align:center"><h2 style="color: blue">Location Hakimi</h2></div>
			  <br>
            <div class="title">Login</div>
			<br>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul style="margin-left:2em">
					@foreach ($errors->all() as $error)
						<li style="color:red ">{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@if (session()->has('msg'))
			<div class="alert alert-danger">
				<ul style="margin-left: 2em">
					<li style="color: red">{{ session('msg') }}</li>
				</ul>
			</div>
			@endif
			@if (session()->has('msgss'))
			<div class="alert alert-success">
				<ul style="margin-left: 2em">
					<li >{{ session('msgss') }}</li>
				</ul>
			</div>
			@endif
		

			<form action="signin" method="post">
				@csrf
				<div class="input-boxes">
				<div class="input-box">
					<i class="fas fa-envelope"></i>
					<input type="text" name="name"  placeholder="Enter your username"  required 
							@if(old('name'))
								value="{{ old('name') }}"
							@endif>
						
				</div>

				<div class="input-box">
					<i class="fas fa-lock"></i>
					<input type="password" name="password" placeholder="Enter your password" required>
				</div>


				
				<div class="text" data-toggle="modal" data-target="#emailModal"><a href="#" >Forgot password or username?</a></div>
				<div class="button input-box">
					<input type="submit" value="Sumbit">
				</div>
				<div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
				</div>
			</form>
      	</div>
		
        <div class="signup-form">
			<div style="text-align:center"><h2 style="color: blue">Location Hakimi</h2></div>

			<br>
          <div class="title">Signup</div>
		  <br>
		  <div id="error-messages" style="color: red"></div>

				<form id="signup-form">
					@csrf
					<div class="input-boxes">	
					<div class="input-box" >
						<i class="fas fa-user"></i>
						<input type="text" id="name"	 name="name" placeholder="Enter your username : John.Loqman" required
						
						>
					</div>
						<div class="input-box">
						<i class="fas fa-envelope"></i>
						<input type="email" name="email" placeholder="Enter your email" required >
					</div>
					<div class="input-box">
						<i class="fas fa-lock"></i>
						<input type="password" name="password" placeholder="Enter your password" required>
					</div>
					<div class="input-box">
						<i class="fas fa-lock"></i>
						<input type="password" name="c_password" placeholder="Confirm your password" required>
					</div>
					<div class="button input-box">
						<input type="submit" value="Sumbit">
					</div>
					
					<div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
					</div>
			</form>
    	</div>

		
    </div>
    </div>
  </div>


  {{-- modal forgot pass --}}

<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title" id="emailModalLabel">Récupérer le mot de passe</h4>

		</div>
		<div class="modal-body">
		  <form action="checkemail" method="post">
			@csrf
			<div class="form-group">
			  <label for="email">Adresse e-mail</label>
			  <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email">
			</div>
			<button type="submit" class="btn btn-primary">submit</button>
		</form>
		</div>
	  </div>
	</div>
  </div>
 
  
</body>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	document.getElementById('signup-form').addEventListener('submit', function(event) {

    event.preventDefault();

    var formData = new FormData(this);

    fetch('/signup', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
				text: 'Inscription réussie. Vous serez redirigé vers la page de connexion.',
                showConfirmButton: false,
                timer: 5500
            }).then(() => {
                window.location.href = '/login';
            });
        } else {
            var errorMessage = '<ul style="text-align:left ">';
            for (var key in data.errors) {
                errorMessage += '<li style="color:red">' + data.errors[key][0] + '</li>';
            }
            errorMessage += '</ul>';
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorMessage
            });
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>
	
</html>
