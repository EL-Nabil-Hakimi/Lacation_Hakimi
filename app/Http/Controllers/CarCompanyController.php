<?php

namespace App\Http\Controllers;

use App\Models\CarCompany;
use Illuminate\Http\Request;

class CarCompanyController extends Controller
{
    //

    public function index()
    {
        $carCompanies = CarCompany::all();
        return response()->json(['data' => $carCompanies], 200);
    }

    public function show($id)
    {
        $carCompany = CarCompany::find($id);
        if (!$carCompany) {
            return response()->json(['message' => 'Car company not found'], 404);
        }
        return response()->json(['data' => $carCompany], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $carCompany = CarCompany::create($request->all());
        return response()->json(['message' => 'Car company created successfully', 'data' => $carCompany], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $carCompany = CarCompany::find($id);
        if (!$carCompany) {
            return response()->json(['message' => 'Car company not found'], 404);
        }

        $carCompany->update($request->all());
        return response()->json(['message' => 'Car company updated successfully', 'data' => $carCompany], 200);
    }

    public function destroy($id)    
    {
        $carCompany = CarCompany::find($id);
        if (!$carCompany) {
            return response()->json(['message' => 'Car company not found'], 404);
        }

        $carCompany->delete();
        return response()->json(['message' => 'Car company deleted successfully'], 200);
    }
}
