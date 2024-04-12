<?php

namespace App\Http\Controllers;

use App\Models\CarCompany;
use App\Models\ModelCar;
use Illuminate\Http\Request;

class ModelCarController extends Controller
{
    //

    public function index()
    {
        $modules = ModelCar::with('company')->latest()->paginate(20);
        $marques = CarCompany::all();
        return view('admin.layout.cars.cars-module' , compact('modules' , 'marques'));
    }

    public function show($id)
    {
        $modelCar = ModelCar::find($id);
        if (!$modelCar) {
            return response()->json(['message' => 'Model car not found'], 404);
        }
        return response()->json(['data' => $modelCar], 200);
    }

    public function store(Request $request)
    {
        $chekmodule = ModelCar::where('name' , $request->name)->where('company_id' , $request->company_id)->first();
        if(!$chekmodule){

            $request->validate([
                'name' => 'required|string',
                'company_id' => 'required|exists:car_companies,id'
            ]);
    
            $modelCar = ModelCar::create($request->all());
            return redirect()->back()->with('success' , 'Le Module a été ajoutée avec succès');
        }
        else{
            
            return redirect()->back()->with('error' , 'Le Module deja existe!');
        }

       
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:model_cars,id,' . $request->marque_id . ',id',
            'company_id' => 'required|exists:car_companies,id'
        ]);

        // dd($request->all());
        $modelCar = ModelCar::find($request->marque_id);
        if (!$modelCar) {
            return redirect()->back()->with('error' , 'Le Module n\'existe pas');   
        }

        $modelCar->update($request->all());
        return redirect()->back()->with('success' , 'Le Module a été modifié avec succès');
    }

    public function delete($id)
    {
        $modelCar = ModelCar::find($id);
        if (!$modelCar) {

            return redirect()->back()->with('error' , 'Le Module n\'existe pas');
        }

        $modelCar->delete();
        return redirect()->back()->with('success' , 'Le Module a été supprimer avec succès');
    }

    public function searchByMark($id)
    {
        $data = ModelCar::where('company_id', $id)->get();
        return response()->json(['data' => $data], 200);
    }
    
}
