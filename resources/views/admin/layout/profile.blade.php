@extends('admin.index')
@section('content')
<style>

  
    .profile-pic {
    border-radius: 50%;
    height: 150px;
    width: 150px;
    background-size: cover;
    background-position: center;
    background-blend-mode: multiply;
    vertical-align: middle;
    text-align: center;
    color: transparent;
    transition: all .3s ease;
    text-decoration: none;
    cursor: pointer;
}

.profile-pic:hover {
    background-color: rgba(0,0,0,.5);
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
</style>
<div class="container">
    <div class="main-body mt-3">

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <form id="photoForm" method="post" enctype="multipart/form-data" action="changephotomanager/{{$user[0]->manager->id}}">
                        @csrf
                        <label for="fileToUpload">
                            <div class="profile-pic" style="background-image: url('{{$user[0]->manager->image}}')">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span><i class="fas fa-image"></i></span>
                            </div>
                        </label>
                        <input type="file" name="image" id="fileToUpload">
                    </form>
                               
                     <div class="mt-3">
                      <h4>{{ $user[0]->manager->nom }} {{ $user[0]->manager->prenom }}</h4>
                      <p class="text-secondary mb-4">{{ $user[0]->role->name }}</p>
                  
                 </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                    <span class="text-secondary">https://bootdey.com</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                    <span class="text-secondary">@bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">bootdey</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">User Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $user[0]->name }}
                        </div>
                      </div>
                      <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{ $user[0]->manager->nom }} {{ $user[0]->manager->prenom }}
                    </div>
                  </div>
                  <hr>
        
                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user[0]->email }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user[0]->manager->phone }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Adresse</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $user[0]->manager->adresse }}
                    </div>
                  </div>
                  <hr>
                  
                  <hr>
                  <div class="row">
                    
                  </div>
                </div>
              </div>

              <div class="row gutters-sm">
                <a onclick="openUpdateModal()" class="btn btn-primary">Changer le mot de passe</a>
            
              </div>



            </div>
          </div>

        </div>
    </div>

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
    
      


      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

  var popupdelmanager = function(id){
    Swal.fire({
        icon: "warning",
        title: "Êtes-vous sûr de vouloir bloquer ce manager ?",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Bloquer",
        cancelButtonText: "Fermer",
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/banmanager/" + id;
        }
    });
 }
  var popuprestoremanager = function(id){
    Swal.fire({
        icon: "warning",
        title: "Êtes-vous sûr de vouloir Debloquer ce manager ?",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Debloquer",
        cancelButtonText: "Fermer",
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/restoremanager/" + id;
        }
    });
 }

 function openUpdateModal() {
    
    var myModal = new bootstrap.Modal(document.getElementById('changermotdepass'));
    myModal.show();
    }

    document.getElementById('fileToUpload').addEventListener('change', function(event) {
        document.getElementById('photoForm').submit(); 
    });
</script>



@endsection