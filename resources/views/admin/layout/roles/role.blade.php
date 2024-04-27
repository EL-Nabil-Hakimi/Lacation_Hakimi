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
        <th>Role</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($roles as $role)            
          <tr>
            <td>
              {{$role->name}}
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
              <button onclick="openUpdateModal({{ $role->id }} , '{{ $role->name }}')" type="button" class="btn btn-link btn-sm btn-rounded">
                <i class="fas fa-edit"></i>
              </button>

              <button onclick="popupdelmanager({{ $role->id }})" type="button" class="btn btn-link btn-sm btn-rounded" style="color: red">
                <i class="fas fa-trash"></i>
              </button>
            

            </td>
          </tr>

      @endforeach
             
    </tbody>
  </table>  
  <div class="liksbtns">{{ $roles->links('pagination::bootstrap-5') }}</div>
</div>





<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modifier Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/admin/Permissions/update">
          @csrf
          <input type="hidden" name="id" id="marque_id">
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom du Role</label>
            <input type="text" name="name" class="form-control" id="nom">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Permissions : </label>
              <div style="padding: 0px 30px; min-height: 10em ;max-height: 20em ;  overflow-y: scroll ;" id="InsertPer">
               
              </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/admin/Permissions/add">
          @csrf
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Nom du Role</label>
            <input type="text" name="name" class="form-control" id="exampleInputName">
          </div>
          <div class="mb-3">
            <label for="exampleInputName" class="form-label">Permissions</label>
              <div style="padding: 0px 30px; min-height: 10em ;max-height: 20em ;  overflow-y: scroll ;">
                @foreach($permissions as $pr)
                  <div>
                    <input type="checkbox" value="{{$pr->id}}" name="per_id[]" id="per_name{{$pr->id}}"> 
                    <label for="per_name{{$pr->id}}" >{{$pr->name}}</label>
                  </div>
                  @endforeach
              </div>
            
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
        title: "Êtes-vous sûr de vouloir bloquer ce manager ?",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Delete",
        cancelButtonText: "Close",
    }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "/admin/Permissions/destroy/" + id;
        }
    });
 }
  




 function openUpdateModal(roleId, roleName) {
    $.ajax({
        url: '/getroles/' + roleId,
        type: 'GET',
        success: function(data) {
            $('#marque_id').val(roleId);
            $('#nom').val(roleName);
            var modalBody = $('#InsertPer');
            modalBody.empty();
            if (data.length > 0) {
                var list = $('<ul>');
                data.forEach(function(permission) {
                    var listItem = $('<li>');
                    var checkbox = $('<input type="checkbox">').attr('name', 'per_id[]').val(permission.id);
                    console.log(permission.id);
                    var hasPermission = false;
                    permission.permissions.forEach(function(perm) {
                        if (perm.permission_id == permission.id) {
                            hasPermission = true;
                        }
                    });
                    if (hasPermission) {
                        checkbox.prop('checked', true);
                    }
                    listItem.append(checkbox);
                    listItem.append('<label>' + permission.name + '</label>');
                    list.append(listItem);
                });
                modalBody.append(list);
            } else {
                modalBody.text('Aucune permission associée à ce rôle.');
            }
            $('#myModal').modal('show');
        },
        error: function() {
            console.error('Une erreur s\'est produite lors de la récupération des données.');
        }
    });
}





</script>
@endsection