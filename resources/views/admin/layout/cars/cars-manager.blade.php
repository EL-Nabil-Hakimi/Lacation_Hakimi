@extends('admin.index')

@section('content')
    
<style>

            @import url("https://fonts.googleapis.com/css2?family=Mulish:wght@400;700&display=swap");
            :root {
            --container: 1025px;
            /* Blues */
            --color-blue-100: #f5faff;
            --color-blue-200: #b8dcff;
            --color-blue-300: #7ab8ff;
            --color-blue-400: #3d90ff;
            --color-blue-500: #0064fe;
            --color-blue-600: #0046d1;
            --color-blue-700: #002ba3;
            --color-blue-800: #001575;
            --color-blue-900: #000647;

            /* Grays */
            --color-gray-100: #f3f5f6;
            --color-gray-200: #d0d8dd;
            --color-gray-300: #aebac2;
            --color-gray-400: #8d9ca7;
            --color-gray-500: #6c7d8b;
            --color-gray-600: #576674;
            --color-gray-700: #424e5c;
            --color-gray-800: #2e3843;
            --color-gray-900: #1c212a;

            /* Neutrals */
            --color-white: white;
            --color-black: black;

            /* Misc */
            --color-border: var(--color-gray-200);

            /* Spacing */
            --space-0: 0;
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;

            /* Font sizes */
            --text-sm: 0.875rem;
            --text-md: 1rem;
            --text-lg: 1.25rem;
            --text-xl: 1.5rem;

            /* Border radius */
            --radius: 6px;
            --radius-lg: 10px;
            --round: 1000px;

            /* Borders */
            --border: 1px solid var(--color-border);

            /* Shadows */
            --shadow: 0px 2px 8px rgba(0, 0, 0, 0.06), 0px 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-large: 0px 5px 18px rgba(0, 0, 0, 0.1),
                0px 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-focus: 0 0 0 var(--space-1) var(--color-blue-200);
            }

        
    
        .card {
        max-width: var(--container);
        width: 90%;
        margin: 5vh auto;
        display: grid;
        grid-template-columns: 1fr;
        background-color: rgb(247, 247, 247);
        gap: 2rem;
        border-radius: var(--radius-lg);
        transition: 0.3s;
        }

        .card:hover{
            box-shadow: 0px 0px 3px 0px;
        background-color: rgb(255, 255, 255);

        }

        .card__image {
        border-top-left-radius: var(--radius);
        border-top-right-radius: var(--radius);
        object-fit: cover;
        width: 100%;
        }

        .card__content {
        padding: var(--space-8);
        }

        .card__head {
        font-size: clamp(1.4rem, 2.5vw, 2rem);
        font-weight: 700;
        color: var(--color-gray-800);
        line-height: 1.2;
        margin-bottom: var(--space-1);
        }

        .card__tag {
        display: block;
        font-size: 1em;
        color: black;
        float: right;
        border-radius: var(--radius);
        padding: var(--space-1) var(--space-2);
        background-color: var(--color-blue-200);
        }

        .card__date {
        display: inline-block;
        font-size: var(--text-sm);
        color: var(--color-gray-500);
        margin-bottom: var(--space-4);
        font-weight: 400;
        }

        .card__text {
        color: var(--color-gray-700);
        font-weight: 400;
        font-size: clamp(1rem, 2.5vw, 1.125rem);
        }

        @media (min-width: 768px) {
        .card {
            grid-template-columns: 1fr 2fr;
            gap: 1rem;
        }
        .card__image {
            height: 100%;
            width: 100%;
            border-top-right-radius: 0;
            border-bottom-left-radius: var(--radius);
        }
        }

        .buttons-acction {
            width:100%;
            display: flex;
            justify-content: flex-end;
            gap: 1em;
        }
        
        .buttons-acction a{
            text-align: center;
            text-decoration: none;
        }


        .buttons-acction a{
            cursor: pointer;
            transition: 0.2s;
        }

        .buttons-acction a:hover{
            transform: rotate(10deg)
        }

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
            z-index: 999999;
            transition: .3s;
            opacity: 0.8;
            
        }

        .circular-button:hover{
            transform: scale(1.1);
            background-color: #0463c8; 
            opacity: 1;

            
        }

        .price_car{
            position: absolute;
            left: .5em;
            top: -.5em;
            height: 4em;
            width: 4em;
            background-color: rgb(78, 99, 219);
            color: rgb(255, 255, 255);
            text-align: center  ;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 0.8em;
            padding: 2.2em ;
            border-radius: 2px 2px 50% 50%;
            border: 2px solid rgb(0, 0, 0);
            font-weight: bold;
            box-shadow: 0px 0px 3px 0px black;
        
        }

        .price_car span{
            font-size: 0.8em;
            color: rgb(232, 232, 232);
        }


        #AddModalManager{
            width: 100vw !important;
            height: 100vh !important;
        
        }

        .small {
    font-size: 0.8em; 
        }

        .card__text i {
            margin-right: 5px; 
        }


        .liksbtns{
            width: 100%;
            padding: 2em 5em;
        }


        #acceptation{
            display: flex;
            justify-content: flex-end;
            width: 100%;
            position: absolute;
            top: -1.5em; 
        }
        
        #acceptation div{
            float: right;
            padding: 0em 2em;
            display: flex;
            justify-content: center;
            border-radius: 5px 5px 0px 0px;
            margin-right: 1em; 
            color: white;
        }

    
</style>


<button class="circular-button" id="AddManagerModal">
    <i class="fas fa-plus"></i>
</button>
  
@forelse($cars as $car)



<div class="card">
 {{-- {{dd($car->accepte )}} --}}
    <div id="acceptation">
        @if($car->accepte == 0)
            <div style="background-color:rgb(1, 1, 162)">En attente</div>
        @elseif($car->accepte == 1)
            <div style="background-color:rgb(5, 116, 18)">Accepté</div>
        @elseif($car->accepte == 2)
            <div style="background-color:rgb(180, 13, 13)">Rejeté</div>
        @endif
    </div>

    <img class="card__image" src="{{asset('images/cars/'.$car->image)}}" />
    <main class="card__content">
            <p  class="price_car">{{$car->prix_par_jour}} <span>Dh/j</span></p>
        

            <div class="buttons-acction">
                {{-- <a href="" class=""><i class="fas fa-info-circle"></i></a> --}}
            @push('scripts')
                <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
            @endpush

            <i class="fas fa-edit text-primary" id="btnedit" onclick="modifier_car(
                        '{{ $car->id }}',
                        '{{ asset('images/cars/'.$car->image) }}',
                        '{{ $car->matricule }}', 
                        '{{ $car->marque->id }}',
                        '{{ $car->model->id }}',
                            '{{ $car->description }}',
                            '{{ $car->transmission }}',
                            '{{ $car->capacite_coffre }}',
                            '{{ $car->type_carburant }}',
                                '{{ $car->nombre_de_sieges }}',
                                '{{ $car->prix_par_jour}}',)">
            </i>
            <a class="text-danger" onclick="Modals({{$car->id}} , 'Confirmer la rendue indisponible' , 'Êtes-vous sûr de vouloir rendre cette voiture indisponible ?' , 'warning' , '/cars/indesponible/')" title="Indisponible"><i class="fas fa-ban"></i></a>
            <a class="text-success" onclick="Modals({{$car->id}} , 'Confirmer la rendue disponible' , 'Êtes-vous sûr de vouloir rendre cette voiture disponible ?' , 'warning' , '/cars/desponible/' )" title="Disponible"><i class="fas fa-check"></i></a>
            @if($car->accepte == null && session()->get('role_id') == 1)
                <a class="text-success" onclick="Modals({{$car->id}} , 'Confirmer l\'acceptation' , 'Êtes-vous sûr d\'accepter cette voiture' ,'warning', '/admin/cars/restore/')" title="Accepter"><i class="bi bi-check-square-fill"></i> </a>
                <a class="text-danger" onclick="Modals({{$car->id}} ,'Confirmer le rejet' , 'Êtes-vous sûr de rejeter cette voiture' , 'warning' ,'/admin/cars/destroy/')" title="Rejeter">  <i class="bi bi-x-square-fill"></i> </a>
            @endif
            @if(session()->get('role_id') == 1)
                <a class="text-danger" onclick="Modals({{$car->id}} , 'Confirmer la suppression' , 'Êtes-vous sûr de vouloir supprimer cette voiture ?' , 'error' , '/admin/cars/delete/')" title="Supprimer"><i class="fas fa-trash"></i></a>
            @endif  

       </div>
        <h1 class="card__head">{{$car->marque->name}}</h1>
       <span class="card__date">Module: {{$car->model->name}}</span>
    <p class="card__text"> {{$car->description}}</p>
    <div class="row">
        <div class="col-md-6">
            <p class="card__text"><i class="fas fa-car"></i> <span class="small">{{$car->transmission}}</span></p>
            <p class="card__text"><i class="fas fa-suitcase"></i> <span class="small">{{$car->capacite_coffre}}</span></p>
        </div>
        <div class="col-md-6">
            <p class="card__text"><i class="fas fa-gas-pump"></i> <span class="small">{{$car->type_carburant}}</span></p>
            <p class="card__text"><i class="fas fa-chair"></i> <span class="small">{{$car->nombre_de_sieges}}</span></p>
        </div>
    </div>
    
    
     
       @if($car->disponibilite == 1)
       <div class="card__availability">
           <i class="fas fa-check-circle" style="color: green;"></i>
            <span class="card__availability-text" style="color: green;">Disponible</span>
       </div>
       @else
        <div class="card__availability">
            <i class="fas fa-times-circle" style="color: red;"></i>
            <span class="card__availability-text" style="color: red;">Indisponible</span>
        </div>
        @endif
        <small class="card__tag mb-2">{{$car->matricule}}</small>

    </main> 
    
</div>
@empty

<div style="width: 100% ; height: 40%; display: flex; justify-content: center; align-items: center">No Cars Found</div>
@endforelse

<div class="liksbtns">{{ $cars->links('pagination::bootstrap-5') }}</div>


<div class="modal fade" id="AddModalManager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Utilisez modal-lg pour une largeur de modal plus grande -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter Voiture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/cars/create" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!--<div class="mb-6 mb-3" style="width: 100%; height: auto;">
                            <img style="width: 100%; height: auto;border-radius: 5px;" src="https://a.storyblok.com/f/143588/1600x1013/d731d7be8f/1dd24b71-599d-4c76-bc3f-4188e135545c_p90447387_highres_the-new-bmw-ix-m60-0.jpg" alt="Description de l'image" style="width: 100%; height: auto;">
                        </div>-->
                        <div class="mb-6 mb-3">
                            <label for="matricule" class="form-label">Matricule</label>
                            <input type="text" name="matricule" class="form-control" id="matricule" required>
                        </div> 
                        <div class="mb-6 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="image" required>
                        </div>
                        <div class="col-md-6"> 
                          
                            <div class="mb-3">
                                <label for="marque" class="form-label">Marque</label>
                                <select class="form-select" name="company_id" id="marque" required>
                                    @foreach($marques as $marque)                                     
                                        <option value="{{$marque->id}}">{{$marque->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre_de_sieges" class="form-label">Nombre de sièges</label>
                                <input type="number" min="0" max="8" name="nombre_de_sieges" class="form-control" id="nombre_de_sieges" required>
                            </div>
                            <div class="mb-3">
                                <label for="type_carburant" class="form-label">Type de Carburant</label>
                                <select class="form-select" name="type_carburant" id="type_carburant" required>
                                    <option value="Essence">Essence</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Hybride">Hybride</option>
                                    <option value="Électrique">Électrique</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>  
                                              

                            
                        </div>
                        <div class="col-md-6"> 
                            <div class="mb-3">
                                <label for="modele" class="form-label">Modèle</label>
                                <select class="form-select" name="model_id" id="modele" required>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <select class="form-select" name="transmission" id="transmission" required>
                                    <option value="Manuelle">Manuelle</option>
                                    <option value="Automatique">Automatique</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="capacite_coffre" class="form-label">Capacité du coffre</label>
                                <input type="number" name="capacite_coffre" class="form-control" id="capacite_coffre" required>
                            </div>

                           

                           
                            
                        </div>

                        <div class="mb-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="5" style="width: 100%;" required></textarea>
                        </div>

                        <div class="col-md-6" >
                        <div class="mb-3">
                            <label for="nombre_de_sieges" class="form-label">Prix Par jour</label>
                            <input type="number" min="0" name="prix_par_jour" class="form-control" id="nombre_de_sieges" required>
                        </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="EditModalManager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier Voiture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <form method="post" action="/cars/update" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="car_id" id="car_id"> 
                    <div class="row">
                         <div class="mb-6 mb-3" style="width: 100%; height: auto;">
                            <img style="width: 100%; height: auto;border-radius: 5px;" src=""id="image_edit" alt="Description de l'image" style="width: 100%; height: auto;">
                        </div>
                        <div class="mb-6 mb-3">
                            <label for="image_edit" class="form-label">Image</label>
                            <input type="file" name="imagecar" class="form-control">
                            <span class="text-danger">Si tu ne veux pas changer la photo, laisse ce champ vide.</span>
                        </div>
                        <div class="mb-6 mb-3">
                            <label for="matricule_edit" class="form-label">Matricule</label>
                            <input type="text" name="matricule" class="form-control" id="matricule_edit" required>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="marque_edit" class="form-label">Marque</label>
                                <select class="form-select" name="company_id" id="marque_edit" required>
                                    @foreach($marques as $marque)&
                                        <option value="{{$marque->id}}">{{$marque->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre_de_sieges_edit" class="form-label">Nombre de sièges</label>
                                <input type="number" min="0" max="8" name="nombre_de_sieges" class="form-control" id="nombre_de_sieges_edit" required>
                            </div>
                            <div class="mb-3">
                                <label for="type_carburant_edit" class="form-label">Type de Carburant</label>
                                <select class="form-select" name="type_carburant" id="type_carburant_edit" required>
                                    <option value="Essence">Essence</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Hybride">Hybride</option>
                                    <option value="Électrique">Électrique</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="modele" class="form-label">Modèle</label>
                                <select class="form-select" name="model_id" id="modele_edit" required>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="transmission_edit" class="form-label">Transmission</label>
                                <select class="form-select" name="transmission" id="transmission_edit" required>
                                    <option value="Manuelle">Manuelle</option>
                                    <option value="Automatique">Automatique</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="capacite_coffre_edit" class="form-label">Capacité du coffre</label>
                                <input type="number" name="capacite_coffre" class="form-control" id="capacite_coffre_edit" required>
                            </div>
                        </div>
                        <div class="mb-6 mb-3">
                            <label for="description_edit" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description_edit" rows="5" style="width: 100%;" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prix_par_jour_edit" class="form-label">Prix Par jour</label>
                                <input type="number" min="0" name="prix_par_jour" class="form-control" id="prix_par_jour_edit" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>



  
<canvas id="myCanvas" width="400" height="200"></canvas>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@12.5.1/dist/sweetalert2.all.min.js"></script>

<script>


    $(document).ready(function() {
        $('#marque_edit').change(function() {
            var marqueId = $(this).val();
            $.ajax({
                url: '/cars/searchByMark/' + marqueId,
                type: 'GET',
                success: function(response) {
                    $('#modele_edit').empty();
                    $.each(response.data, function(key, value) {
                        $('#modele_edit').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
                });
            });
        });


    $(document).ready(function() {
        $('#marque').change(function() {
            var marqueId = $(this).val();
            $.ajax({
                url: '/cars/searchByMark/' + marqueId,
                type: 'GET',
                success: function(response) {
                    $('#modele').empty();
                    $.each(response.data, function(key, value) {
                        $('#modele').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });


    
    document.getElementById("AddManagerModal").addEventListener("click", function() {
        var myModal = new bootstrap.Modal(document.getElementById('AddModalManager'));
        document.getElementById('AddManagerModal').style.display = 'none';

        myModal.show()
    
        myModal._element.addEventListener('hide.bs.modal', function() {
            document.getElementById('AddManagerModal').style.display = 'block';
    });

    });
    var modifier_car = function(carId, imageUrl, matricule, marque, model, description, transmission, capacite_coffre, type_carburant, nombre_de_sieges , prix_par_jour) {
        // console.log(carId , imageUrl , matricule, marque, model, description, transmission, capacite_coffre ,imageUrl)

    document.getElementById('car_id').value = carId;
    document.getElementById('image_edit').src = imageUrl;
    document.getElementById('matricule_edit').value = matricule;
    document.getElementById('marque_edit').value = marque;
    document.getElementById('modele_edit').value = model;
    document.getElementById('description_edit').value = description;
    document.getElementById('transmission_edit').value = transmission;
    document.getElementById('capacite_coffre_edit').value = capacite_coffre;
    document.getElementById('type_carburant_edit').value = type_carburant;
    document.getElementById('nombre_de_sieges_edit').value = nombre_de_sieges;
    document.getElementById('capacite_coffre_edit').value = capacite_coffre;    
    document.getElementById('prix_par_jour_edit').value = prix_par_jour;

    $.ajax({
            url: '/cars/searchByMark/' + marque,
            type: 'GET',
            success: function(response) {
                $('#modele_edit').empty();
                $.each(response.data, function(key, value) {
                    $('#modele_edit').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
            });    
  
    var myModal = new bootstrap.Modal(document.getElementById('EditModalManager'));
    myModal.show();

        } 
  
    var Modals = function(id , title , text , type , route) {
        Swal.fire({
            title: title,
            text: text,
            icon: type,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Oui',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                url = route;
                window.location.href = url + id;

            }
        });
    }
  
</script>

@endsection
