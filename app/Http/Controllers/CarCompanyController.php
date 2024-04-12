<?php

namespace App\Http\Controllers;

use App\Models\CarCompany;
use Illuminate\Http\Request;

class CarCompanyController extends Controller
{
    //

    public function index()
    {
        $marques = CarCompany::latest()->paginate(10);
        return view('admin.layout.cars.cars-marque' , compact('marques'));
    }
    

    public function show($id)
    {
        

        $carCompany = CarCompany::find($id);
        if (!$carCompany) {
            return redirect()->back()->with('error' , 'La marque a exist pas');
        }
        return redirect()->back()->with('success' , 'La marque a été modifier avec succès');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required|string|unique:car_companies'
        ]);
        
        $carCompany = CarCompany::create($request->all());
        return redirect()->back()->with('success' , 'La marque a été ajoutée avec succès');
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|unique:car_companies,name,' . $request->marque_id . ',id',
        ]);
            

        $request->marque_id;

        $carCompany = CarCompany::find($request->marque_id);
        if (!$carCompany) {
            return redirect()->back()->with('error' , 'La marque n\'existe pas');
        }

        $carCompany->update($request->all());
        return redirect()->back()->with('success' , 'La marque a été modifier avec succès');
    }

    public function delete($id)    
    {
        $carCompany = CarCompany::find($id);
        if (!$carCompany) {
            return redirect()->back()->with('error' , 'La marque n\'existe pas');
        }

        $carCompany->delete();
        return redirect()->back()->with('success' , 'La marque a été supprimer avec succès');
    }


    public function datajsnon()
    {
        $marques = CarCompany::all();
        return response()->json(['data' => $marques], 200);
    }

}
