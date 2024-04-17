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

  #verifyimg{
    width: 20px;
    height: 20px;
    position: absolute;
    top: -.2em;
    left: -.6em;
  }

  #div_table th{
        background-color: #ffffff;
        transition: 0.3s; 
  }
  
  #div_table tr{
        background-color: #f5f5f5;
        transition: 0.3s; 
  }
  #div_table tr:hover{
        background-color: #ffffff;
  }


</style>



<div style="min-height: 70vh; margin-top: 6em; overflow-x: auto ; padding: 10px 10px" id="div_table">
  <table class="table align-middle mb-0 mt-5 bg-white" style="width: 100%;">
    <thead class="bg-light">
      <tr>
        <th>Name</th>
        <th>Cin</th>
        <th>Tele</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clients as $client)
      <tr>
        <td>
          <div class="d-flex align-items-center" style="position: relative">
            @if($client->client->accepte == 1)
            <img src="{{asset('images/verify.png')}}" id="verifyimg" title="Ce Compte a été vérifié par les responsables">
            @endif

            <img src="{{ asset($client->client->image) }}" alt="" style="width: 45px; height: 45px" class="rounded-circle">
            <div class="ms-3">
              <a href="/profileusershow/{{$client->id}}">
                <p class="fw-bold mb-1">{{$client->name}}</p>
              </a>
              <p class="text-muted mb-0">{{$client->email}}</p>
            </div>
          </div>
        </td>
        <td>{{$client->client->cin}}</td>
        <td>
          <p class="fw-normal mb-2">{{$client->client->phone}}</p>
        </td>
    
        <td>
          @if ($client->ban == 1)
          <span class="badge badge-danger rounded-pill d-inline">Bloque</span>
          @else
          <span class="badge badge-success rounded-pill d-inline">Actif</span>
          @endif
        </td>
        <td>
          @if ($client->ban == 1)
          <button onclick="popuprestoreuser({{ $client->id }})" type="button" class="btn btn-link btn-sm btn-rounded" style="color: red">Debloquer</button>
          @else
          <button onclick="popupbanuser({{ $client->id }})" type="button" class="btn btn-link btn-sm btn-rounded" style="color: red">Bloquer</button>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>









<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

  var popupbanuser = function(id){
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
  var popuprestoreuser = function(id){
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


</script>
@endsection