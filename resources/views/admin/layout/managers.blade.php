@extends('admin.index')
@section('content')
<style>
  /* Custom CSS for circular button */
  .circular-button {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #007bff; 
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff; 
    border: none;
    position: fixed;
    right:  1.6em;
    margin: 20px;
    bottom: 5em;
    transition: .3s;
    opacity: 0.8;
    
  }

  .circular-button:hover{
    transform: scale(1.1);
    background-color: #0463c8; 
    opacity: 1;

    
  }
</style>


<button class="circular-button" id="AddManagerModal">
  <i class="fas fa-plus"></i>
</button>


<div style="min-height: 70vh; margin-top: 6em; ">
  <table class="table align-middle mb-0 mt-5 bg-white" style="width: 100%;">
    <thead class="bg-light">
      <tr>
        <th>Name</th>
        <th>Cin</th>
        <th>Tele</th>
        <th>Role</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($managers as $manager)
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <img src="{{asset($manager->manager->image)}}" alt="" style="width: 45px; height: 45px" class="rounded-circle">
            <div class="ms-3">
              <a href="/profileshow?user={{$manager->id}}">
                <p class="fw-bold mb-1">{{$manager->name}}</p>
              </a>
              <p class="text-muted mb-0">{{$manager->email}}</p>
            </div>
          </div>
        </td>
        <td>{{$manager->manager->cin}}</td>
        <td>
          <p class="fw-normal mb-2">{{$manager->manager->phone}}</p>
        </td>
        <td>
          <p class="fw-normal mb-2">{{$manager->role->name}}</p>
        </td>
        <td>
          @if ($manager->ban == 1)
          <span class="badge badge-danger rounded-pill d-inline">Bloque</span>
          @else
          <span class="badge badge-success rounded-pill d-inline">Actif</span>
          @endif
        </td>
        <td>
          <button onclick="openUpdateModal({{ $manager->id }}, '{{ $manager->manager->nom }}', '{{ $manager->manager->prenom }}', '{{ $manager->manager->cin }}', '{{ $manager->manager->phone }}', '{{ $manager->email }}', '{{ $manager->role_id }}' , '{{ $manager->manager->adresse }}')" type="button" class="btn btn-link btn-sm btn-rounded">Edit</button>
          @if ($manager->ban == 1)
          <button onclick="popuprestoremanager({{ $manager->id }})" type="button" class="btn btn-link btn-sm btn-rounded" style="color: red">Debloquer</button>
          @else
          <button onclick="popupdelmanager({{ $manager->id }})" type="button" class="btn btn-link btn-sm btn-rounded" style="color: red">Bloquer</button>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>






<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Manager</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/updatemanager">
          @csrf
          <input type="hidden" name="id" id="manager_id">
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="nom">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Prenom</label>
            <input type="text" name="prenom" class="form-control" id="prenom">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">CIN</label>
            <input type="text" name="cin" class="form-control" id="cin">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Tele</label>
            <input type="text" name="phone" class="form-control" id="phone">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" id="Adresse">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="email">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Role</label>
            <select name="role_id" class="form-control" id="role_id">
              <option value="0" disabled>Selectionner le Role</option>
             
              @foreach ($roles as $role)
                @if ($role->id != 1 && $role->id != 3)
                  @if (!empty($mangers) && $manager->role_id == $role->id)
                  <option value="{{$role->id}}" selected>{{$role->name}}</option>
                  @else    
                  <option value="{{$role->id}}">{{$role->name}}</option>
                  @endif
                @endif
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="AddModalManager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Manager</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/createmanager">
          @csrf
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" id="exampleInputName">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Prenom</label>
            <input type="text" name="prenom"  class="form-control" id="exampleInputName">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">CIN</label>
            <input type="text" name="cin" class="form-control" id="exampleInputName">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Tele</label>
            <input type="text" name="phone" class="form-control" id="exampleInputName">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Email</label>
            <input type="text" name="email"  class="form-control" id="exampleInputName">
          </div>
          <div class="mb-3">

            <label for="exampleInputName" class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" id="adresse">
          </div>

          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Role</label>
            <select name="role_id" class="form-control" id="exampleInputName">
              <option selected>Selectionner le Role</ option>
                @foreach ($roles as $role)
                  @if ($role->id != 1 && $role->id != 3)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                  @endif
                @endforeach

            </select>
          </div>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  document.getElementById("AddManagerModal").addEventListener("click", function() {
    var myModal = new bootstrap.Modal(document.getElementById('AddModalManager'));
    myModal.show();
  });

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
          window.location.href = "/banuser/" + id;
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
          window.location.href = "/restoruser/" + id;
        }
    });
 }

 function openUpdateModal(id, nom, prenom, cin, phone, email, role_id , adresse) {
    console.log(adresse)
    document.getElementById('manager_id').value = id;
    document.getElementById('nom').value = nom;
    document.getElementById('prenom').value = prenom;
    document.getElementById('cin').value = cin;
    document.getElementById('phone').value = phone;
    document.getElementById('email').value = email;
    document.getElementById('role_id').value = role_id;
    document.getElementById('Adresse').value = adresse;
    
    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    myModal.show();
    }

</script>
@endsection