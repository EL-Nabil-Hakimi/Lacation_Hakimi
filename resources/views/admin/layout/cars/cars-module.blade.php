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

  .liksbtns{
            width: 100%;
            padding: 2em 1em;
        }
</style>


<button class="circular-button" id="AddManagerModal">
  <i class="fas fa-plus"></i>
</button>


<div style="min-height:70vh ; margin-top : 6em" >
<table class="table align-middle mb-0 mt-5 bg-white"  >
    <thead class="bg-light">
      <tr>
        <th>Module</th>
        <th>Marque</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($modules as $module)            
          <tr>
            <td>
              {{$module->name}}
            </td>

            <td>
              {{$module->company->name}}
              
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
              
            </td>
            <td>
              
            </td>

            <td>

            </td>
           
            <td>
              <button onclick="openUpdateModal({{ $module->id }} , '{{ $module->name }}' , '{{ $module->company_id }}')" type="button" class="btn btn-link btn-sm btn-rounded">
                <i class="fas fa-edit"></i>
              </button>

              <button onclick="popupdelmanager({{ $module->id }})" type="button" class="btn btn-link btn-sm btn-rounded" style="color: red">
                <i class="fas fa-trash"></i>
              </button>

            </td>
          </tr>

      @endforeach
             
    </tbody>
  </table>  
  <div class="liksbtns">{{ $modules->links('pagination::bootstrap-5') }}</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier module</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/module/update">
          @csrf
          <input type="hidden" name="marque_id" id="marque_id">
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom du marque</label>
            <input type="text" name="name" class="form-control" id="nom">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom du marque</label>
            <select class="form-control"  name="company_id" id="select_marque">
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
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Marque</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/module/add">
          @csrf
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom du marque</label>
            <input type="text" name="name" class="form-control" id="exampleInputName" required>
          </div>
          <div class="mb-3">
            <select class="form-control"  name="company_id" id="selected_marque">
                @foreach ($marques as $marque)
                  <option value="{{ $marque->id }}">{{ $marque->name }}</option>
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
        icon: "error",
        title: "Êtes-vous sûr de supprimer ce module ?",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Bloquer",
        cancelButtonText: "Fermer",
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/module/delete/" + id;
        }
    });
 }
  

 function openUpdateModal(id, nom, company_id) {
    console.log(id, nom, company_id);
    document.getElementById('marque_id').value = id;
    document.getElementById('nom').value = nom;

    $.ajax({
        url: '/api/marques/',
        type: 'GET',
        success: function(response) {
            $('#select_marque').empty();
            $.each(response.data, function(key, value) {
                if (value.id == company_id) {
                    $('#select_marque').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                } else {
                    $('#select_marque').append('<option value="' + value.id + '">' + value.name + '</option>');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('AJAX request failed:', status, error);
        }
    });

    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    myModal.show();
}



</script>
@endsection