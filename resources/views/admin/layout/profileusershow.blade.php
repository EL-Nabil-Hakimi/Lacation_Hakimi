    <!-- User Profile -->
    @extends('admin.index') 
    @section('content')

    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        
        <meta charset="utf-8">
        <title>My Car</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        
    
        <!-- Favicon -->
        <link href="{{asset('assets/admin/img/favicon.ico')}}" rel="icon">
    
    
        <link href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css')}}" rel="stylesheet">
    
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Icon Font Stylesheet -->
        <link href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css')}}" rel="stylesheet">
        <link href="{{asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css')}}" rel="stylesheet">
    
        <!-- Libraries Stylesheet -->
        <link href="{{asset('assets/admin/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
    
        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
    
        <!-- Template Stylesheet -->
        <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet">
        
    </head>
    
    <body >

      <style>

        body {
            padding: 0;
            margin: 0;
            font-family: 'Lato', sans-serif;
            color: #000;
        }
    
        /*user-profile*/
    
        .user-profile .card {
            border-radius: 10px;
        }
    
        .user-profile .card h3 {
            font-size: 20px;
            font-weight: 700;
        }
    
        .user-profile .card .card-header .profile_img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 10px auto;
            border: 10px solid #ccc;
            border-radius: 50%;
        }
    
        .user-profile .card .card-body .side-menu .nav-link {
            font-size: 16px;
            color: #222;
        }
    
        .user-profile li span {
            font-size: 18px;
        } 
    
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
    
        /* input file style */
    
        .input-file {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
    
        .input-file + .js-labelFile {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 10px;
            cursor: pointer;
        }
    
        .input-file + .js-labelFile .icon:before {
            content: "\f093";
        }
    
        .input-file + .js-labelFile.has-file .icon:before {
            content: "\f00c";
            color: #5AAC7B;
        }
    

        .icoco:hover{
              color: blue;
        }
        .custom-swal-popup {
           background: transparent !important;
          width: 80%;
        }

        .custom-swal-close-button {
          color: #000; 
        }

        .custom-swal-close-button::before {
            color: white !important;
          }

          #permiImg{
            display: flex;
            justify-content: center;
            gap: 1em;


          }
          #permiImg img{
            width: 48%
          }


          #headerclientinfo {
            background-color : rgb(80, 127, 237);
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1em;
            border-radius: 10px 10px 0px 0px;
            margin-bottom: 10px;

          }

         
          
          #headerclientinfo li{
            color:white;
            transition: 0.3s;
          }
          #headerclientinfo i{
            color:white;
            transition: 0.3s;
          }

          #headerclientinfo li:hover{
            transform: rotate(-3deg);
          }
       

          #verifyimg {
                position: absolute;
                width: 40px;
                height: 40px;
                top:-2px; 
                left: 0px;
            }


            
          

    </style>
    

<div class="user-profile py-4">
  <div class="container">
    
    <div class="row">
      
      <div class="col-lg-4">

        
        <div class="card shadow-sm ">

            <div id="headerclientinfo">
            
            @if($user[0]->client->accepte == null && $user[0]->client )
            <li class="nav-item d-flex justify-content-end p-2">
              <button class="btn" onclick="openComfirmModalinfo({{$user[0]->client->id}})" title="Je confirme que cette personne est réelle et que les informations fournies sont correctes?">
                  <i class="far fa-square fa-lg"></i>  
                  <span style="color: white">Confirmer</span>
              </button>
              </li>
              <li class="nav-item d-flex justify-content-end p-2">

              <button class="btn" onclick="openCancelConfirmationModal({{$user[0]->client->id}})" title="Je ne suis pas sûr">
                  <i class="far fa-square fa-lg"></i>  
                  <span style="color: white">Infirmer</span>
              </button>
                  </li>
            @elseif($user[0]->client->accepte == 1)
            <li class="nav-item d-flex justify-content-end p-2">
              <button class="btn" onclick="openComfirmModalinfo({{$user[0]->client->id}})" title="Je confirme que cette personne est réelle et que les informations fournies sont correctes?">
                  <i class="far fa-check-square fa-lg"></i>  
                  <span style="color: white">Confirmer</span>
              </button>
              </li>
              <li class="nav-item d-flex justify-content-end p-2">

              <button class="btn" onclick="openCancelConfirmationModal({{$user[0]->client->id}})" title="Je ne suis pas sûr">
                  <i class="far fa-square fa-lg"></i>  
                  <span style="color: white">Infirmer</span>
              </button>
                  </li>
            @else
            <li class="nav-item d-flex justify-content-end p-2">
              <button class="btn" onclick="openComfirmModalinfo({{$user[0]->client->id}})" title="Je confirme que cette personne est réelle et que les informations fournies sont correctes?">
                  <i class="far fa-square fa-lg"></i>  
                  <span style="color: white">Confirmer</span>
              </button>
              </li>
              <li class="nav-item d-flex justify-content-end p-2">

              <button class="btn" onclick="openCancelConfirmationModal({{$user[0]->client->id}})" title="Je ne suis pas sûr">
                  <i class="far fa-check-square fa-lg"></i>  
                  <span style="color: white">Infirmer</span>
              </button>
                  </li>
              
            @endif
          

            </div>
          <div class="card-header bg-transparent text-center">
            <form id="photoForm" method="post" enctype="multipart/form-data" action="/changephotouser/{{$user[0]->client->id}}">
              @csrf
              <label for="fileToUpload">
                  <div class="profile-pic" style="background-image: url('{{asset($user[0]->client->image)}}')">
                    @if($user[0]->client->accepte == 1)
                      <img src="{{asset('images/verify.png')}}" id="verifyimg" title="Ce Compte a été vérifié par les responsables">
                    @endif
                      <span class="glyphicon glyphicon-camera"></span>
                      <span><i class="fas fa-image"></i></span>
                  </div>
              </label>
          </form>
          
          </div>
          <div class="card-body">
           
            <ul class="nav flex-column side-menu">
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em;color : rgb(32, 44, 181) ;">Nom </span>
                  <span>{{ $user[0]->client->nom }}</span>
              </li>
              <hr>  
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em;color : rgb(32, 44, 181) ;">Prenom </span>
                  <span> {{ $user[0]->client->prenom }}</span>
              </li>
              <hr>
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em; color : rgb(32, 44, 181) ;">Cin </span>
                  <span>{{ $user[0]->client->cin }}</span>
              </li>
              <hr>
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em; color : rgb(32, 44, 181) ;">Tele </span>
                  <span>{{ $user[0]->client->phone }}</span>
              </li>
              <hr>
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em; color : rgb(32, 44, 181) ; ">Email </span>
                  <span>{{ $user[0]->email }}</span>
              </li>
              <hr>
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em; color : rgb(32, 44, 181) ; ">Adress </span>
                  <p>{{ $user[0]->client->adresse}}</p>
              </li>
              <hr>
             
              <li class="nav-item d-flex">
                  <span class="me-2" style="width:25% ; height:1.5em; color : rgb(32, 44, 181) ; ">Permis  </span>
              </li>
              <li class="nav-item" >
                <div id="permiImg">
                  <img onclick="openImage('{{ asset($user[0]->client->permi) }}')" src="{{ asset($user[0]->client->permi) }}" alt="" >
                  <img onclick="openImage('{{ asset($user[0]->client->permi) }}')" src="{{ asset($user[0]->client->permi) }}" alt="" >
              </div>
              
              </li>
              
          </ul>
          
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm mb-3">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Shoping Status</h3>
          </div>
          <div class="card-body pt-0" style="overflow-x: auto;">
            <table class="table table-bordered" >
              <tr class="bg-light">
                <th>Date</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <tr>
                <td>19/05/2020</td>
                <td>Makeup</td>
                <td>6</td>
                <td>6,000</td>
                <td><span class="badge badge-success">Deliverd</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-success">View</button>
                </td>
              </tr>
              <tr>
                <td>19/05/2020</td>
                <td>Lipstick</td>
                <td>12</td>
                <td>10,000</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-success">View</button>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card shadow-sm mb-3" style="overflow-x: auto;">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Shoping History</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr class="bg-light">
                <th>Date</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <tr>
                <td>19/05/2020</td>
                <td>Makeup</td>
                <td>6</td>
                <td>6,000</td>
                <td><span class="badge badge-success">Deliverd</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-primary">Reorder</button>
                </td>
              </tr>
              <tr>
                <td>19/05/2020</td>
                <td>Lipstick</td>
                <td>12</td>
                <td>10,000</td>
                <td><span class="badge badge-danger">Cancel</span></td>
                <td>
                  <button type="button" class="btn btn-sm btn-primary">Reorder</button>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Ajouter des souvenirs</h3>
          </div>
          <div class="card-body pt-0">
            <form action="#">
              <div class="form-group">
                  <label for="">Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
              </div>
              <div class="form-group">
                  <label for="name">Titre</label>
                  <input type="text" class="form-control" id="name" aria-describedby="name">
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /User Profile -->
        <div class="modal fade" id="changermotdepass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier le mot de passe</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/modifiermotdepass">
                            @csrf
                            <input type="hidden" name="id" value="{{$user[0]->id}}">
                            
                            <div class="mb-3">
                                <label for="oldmdp" class="form-label">Ancien mot de passe</label>
                                <input type="password" name="oldmdp" class="form-control" id="oldmdp" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="newmdp" class="form-label">Nouveau mot de passe</label>
                                <input type="password" name="newmdp" class="form-control" id="newmdp" required minlength="8">
                                <div id="passwordHelpBlock" class="form-text text-danger">
                                    Le mot de passe doit avoir au moins 8 caractères.
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="c_newmdp" class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" name="c_newmdp" class="form-control" id="c_newmdp" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        
          


        <div class="modal fade" id="modifierinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier les information</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="/updateinfo" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="user_id" value="{{$user[0]->id}}">
                      <input type="hidden" name="id" value="{{$user[0]->client->id}}">
                      
                      <div class="form-group">
                        <input type="file" name="permi" id="file" class="input-file">
                        <label for="file" class="btn btn-tertiary js-labelFile">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">Permis de conduire</span>
                        </label>
                      </div>
                      
                  
                      <div class="mb-3">
                          <label for="cin" class="form-label">Cin</label>
                          <input type="text" name="cin" class="form-control" value="{{$user[0]->client->cin}}" id="cin" required>
                      </div>

                      <div class="mb-3">
                          <label for="nom" class="form-label">Nom</label>
                          <input type="text" name="nom" class="form-control" value="{{$user[0]->client->nom}}" id="nom" required>
                      </div>
                      <div class="mb-3">
                          <label for="prenom" class="form-label">Prenom</label>
                          <input type="text" name="prenom" class="form-control" value="{{$user[0]->client->prenom}}" id="prenom" required>
                      </div>
                      <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" name="email" class="form-control"  value="{{$user[0]->email}}" id="email">
                      </div>
                      <div class="mb-3">
                          <label for="phone" class="form-label">Tele</label>
                          <input type="text" name="phone" class="form-control" value="{{$user[0]->client->phone}}" id="phone" required>
                      </div>
                      <div class="mb-3">
                          <label for="adresse" class="form-label">Adresse</label>
                          <input type="text" name="adresse" class="form-control" value="{{$user[0]->client->adresse}}" id="adresse" required>
                      </div>
                      
                      <button type="submit" class="btn btn-primary">Modifier</button>
                  </form>
                  
                      
                  </div>
              </div>
          </div>
      </div>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="{{asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    
   


    <script>
      var openImage = function(img){
            Swal.fire({
              html: '<img src="'+img+'" alt="" style="width: 80%;">',
              showCloseButton: true,
              showCancelButton: false,
              showConfirmButton: false,
              background: 'transparent',
              customClass: {
                popup: 'custom-swal-popup',
                closeButton: 'custom-swal-close-button'
              }
            });
    }

    var openComfirmModalinfo = function(id) {
    Swal.fire({
        title: 'Tu confirmes que cette personne est réelle et que les informations fournies sont correctes?',
        icon: 'question',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'OUI',
        cancelButtonText: 'Non',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/manager/accepteuser/' + id;
        }
    });
};
    var openCancelConfirmationModal = function(id) {
    Swal.fire({
      title: 'Vous avez des doutes sur la véracité des informations fournies par cette personne?',
        icon: 'question',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: 'OUI',
        cancelButtonText: 'Non',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/manager/refuseuser/' + id;
        }
    });
};



$(function() {
    $('.input-file').each(function() {
        var $input = $(this),
            $label = $input.next('.js-labelFile'),
            labelVal = $label.html();

        $input.on('change', function(element) {
            var fileName = '';
            if (element.target.value) fileName = element.target.value.split('\\').pop();
            fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
        });
    });
});

    function openUpdateModal() {
        
        var myModal = new bootstrap.Modal(document.getElementById('changermotdepass'));
        myModal.show();
        }

        document.getElementById('fileToUpload').addEventListener('change', function(event) {
            document.getElementById('photoForm').submit(); 
        });

    function openUpdateModalinfo() {
        
        var myModal = new bootstrap.Modal(document.getElementById('modifierinfo'));
        myModal.show();
        }

        document.getElementById('fileToUpload').addEventListener('change', function(event) {
            document.getElementById('photoForm').submit(); 
        });
       

    </script>


@endsection



