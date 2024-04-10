<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'type_carburant',
        'transmission',
        'nombre_de_sieges',
        'capacite_coffre',
        'prix_par_jour',
        'disponibilite',
        'accepte',
        'description',
        'user_id',
        'company_id',
        'model_id',
        'image',
    ];

    public function marque(){
        return $this->belongsTo(CarCompany::class , 'company_id');
    }
    public function model()
    {
        return $this->belongsTo(ModelCar::class, 'model_id');
    }
}
