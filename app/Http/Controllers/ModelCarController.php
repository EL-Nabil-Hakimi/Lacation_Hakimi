<?php

namespace App\Http\Controllers;

use App\Models\ModelCar;
use Illuminate\Http\Request;

class ModelCarController extends Controller
{
    //

    public function index()
    {
        $modelCars = ModelCar::all();
        return response()->json(['data' => $modelCars], 200);
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
        $request->validate([
            'name' => 'required|string',
            'company_id' => 'required|exists:car_companies,id'
        ]);

        $modelCar = ModelCar::create($request->all());
        return response()->json(['message' => 'Model car created successfully', 'data' => $modelCar], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'company_id' => 'required|exists:car_companies,id'
        ]);

        $modelCar = ModelCar::find($id);
        if (!$modelCar) {
            return response()->json(['message' => 'Model car not found'], 404);
        }

        $modelCar->update($request->all());
        return response()->json(['message' => 'Model car updated successfully', 'data' => $modelCar], 200);
    }

    public function destroy($id)
    {
        $modelCar = ModelCar::find($id);
        if (!$modelCar) {
            return response()->json(['message' => 'Model car not found'], 404);
        }

        $modelCar->delete();
        return response()->json(['message' => 'Model car deleted successfully'], 200);
    }

    public function searchByMark($id)
    {
        $data = ModelCar::where('company_id', $id)->get();
        return response()->json(['data' => $data], 200);
    }
    
}
