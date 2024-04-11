<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarCompany;
use App\Models\ModelCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
    
class CarController extends Controller
{
    //



    public function index()
    {
        $user_id = 2; 

        $cars = Car::where('accepte', true)->get();

        // return view('cars.index', ['cars' => $cars]);
        return response()->json($cars);
    }
    public function ManagerIndex()
    {
        $user_id  = Session::get('user_id');
        
        $cars = Car::with('marque')->with('model')->where('user_id', $user_id)->latest()->paginate(5);
        $marques = CarCompany::all();
        $models = ModelCar::all();
        // dd($cars);
        return view('admin.layout.cars.cars-manager' , compact('cars' , 'models',   'marques'));
        // return response()->json($cars);
    }
    public function AdminIndex()
    {
        $user_id  = Session::get('user_id');

        if(Session::get('role_id') != 1){
            return redirect('/login');
        }

        $cars = Car::with('marque')->with('model')->latest()->paginate(5);
        $marques = CarCompany::all();
        $models = ModelCar::all();
        // dd($cars);
        return view('admin.layout.cars.cars-manager' , compact('cars' , 'models',   'marques' , 'user_id'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $user_id  = Session::get('user_id');
        // dd($user_id);

        $validator = Validator::make($request->all(), [
            'matricule' => 'required|string|unique:cars,matricule|max:255',
            'type_carburant' => 'required|string|in:Essence,Diesel,Hybride,Électrique,Autre',
            'transmission' => 'required|string|in:Manuelle,Automatique,Autre',
            'nombre_de_sieges' => 'required|integer|min:1',
            'capacite_coffre' => 'required|integer|min:1',
            'prix_par_jour' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // dd($request->all());
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/cars'), $imageName);
        
        $car = Car::create([
            'matricule' => $request->matricule,
            'type_carburant' => $request->type_carburant,
            'transmission' => $request->transmission,
            'nombre_de_sieges' => $request->nombre_de_sieges,
            'capacite_coffre' => $request->capacite_coffre,
            'prix_par_jour' => $request->prix_par_jour,
            'disponibilite' => true,
            'accepte' => 0,
            'description' => $request->description,
            'user_id' => $user_id,
            'company_id' => $request->company_id,
            'model_id' => $request->model_id,
            'image' => $imageName,
        ]);

        // return response()->json(['message' => 'La voiture a été créée avec succès.']);
        return redirect()->back()->with('success', 'La voiture a été créée avec succes');
    }
    public function show($id)
    {
        $user_id = 2;

        $car = Car::where('user_id', $user_id)->findOrFail($id);

        // return view('cars.show', ['car' => $car]);
        return response()->json($car);
    }

    public function update(Request $request)
    {
        $user_id  = 2; 

        $validator = Validator::make($request->all(), [
            'matricule' => 'required|string|max:255|unique:cars,matricule,'. $request->car_id,
            'type_carburant' => 'required|string|in:Essence,Diesel,Hybride,Électrique,Autre',
            'transmission' => 'required|string|in:Manuelle,Automatique,Autre',
            'nombre_de_sieges' => 'required|integer|min:1',
            'capacite_coffre' => 'required|integer|min:1',
            'prix_par_jour' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'imagecar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed.', 'errors' => $validator->errors()], 400);
        }
        // dd($request->car_id);
        $car = Car::findOrFail($request->car_id);
    
        if ($request->hasFile('imagecar')) {
            $image = $request->file('imagecar');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/cars'), $imageName);
            $car->image = $imageName;
        }
        
    
        $car->update([
            'matricule' => $request->matricule,
            'type_carburant' => $request->type_carburant,
            'transmission' => $request->transmission,
            'nombre_de_sieges' => $request->nombre_de_sieges,
            'capacite_coffre' => $request->capacite_coffre,
            'prix_par_jour' => $request->prix_par_jour,
            'disponibilite' => true,
            'accepte' => 0,
            'description' => $request->description,
            'user_id' => $user_id, 
            'company_id' => $request->company_id,
            'model_id' => $request->model_id,
        ]);
        return redirect()->back()->with('success', 'La voiture a été Modifier avec succes');
    }
    

    public function destroy($id)
    {   
        // dd('hamiiiiiiiiiiiid');

        $car = Car::findOrFail($id);
        $car->accepte = 2;
        $car->save();

        return redirect()->back()->with('success', 'La voiture a été supprimée avec succès.');
        // return response()->json(['message' => 'La voiture a été supprimée avec succès.']);
    }



    public function restore($id)
    {

        $car = Car::findOrFail($id);
        $car->accepte = 1;
        $car->save();

        return redirect()->back()->with('success', 'La voiture a été supprimée avec succès.');
        // return response()->json(['message' => 'La voiture a été restaurée avec succès.']);
    }


    public function delete($id)
    {

        $car = Car::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'La voiture a été supprimée avec succès.');
        // return response()->json(['message' => 'La voiture a été restaurée avec succès.']);
    }


    public function desponible($id)
    {   
        // dd('hamiiiiiiiiiiiid');
        $user_id = 2;

        $car = Car::findOrFail($id);
        $car->disponibilite = 1;
        $car->save();

        return redirect()->back()->with('success', 'La voiture a été disponible avec succès.');
        // return response()->json(['message' => 'La voiture a été supprimée avec succès.']);
    }

    public function indesponible($id)
    {
        $user_id = 2;

        $car = Car::findOrFail($id);
        $car->disponibilite = 0;
        $car->save();

        return redirect()->back()->with('success', 'La voiture a été indesponible avec succès.');
        // return response()->json(['message' => 'La voiture a été restaurée avec succès.']);
    }


    public function saveCarModels(Request $request)
    {
        $data = $request->json()->all();

        
        foreach ($data as $item) {
            $company = CarCompany::firstOrCreate(['name' => $item['company']]);

            foreach ($item['model'] as $modelName) {
                $model = new ModelCar(['name' => $modelName]);

                $model->company()->associate($company);

                $model->save();
            }
        }

        return response()->json(['message' => 'Les modèles de voitures ont été sauvegardés avec succès.']);
    }

    public function searchByMatricule(Request $request)
    {
        $matricule = $request->input('matricule');
        $modelCars = Car::where('matricule', $matricule)->get();
        if ($modelCars->isEmpty()) {
            return response()->json(['message' => 'No model cars found with the given matricule'], 404);
        }
        return response()->json(['data' => $modelCars], 200);
    }
}
