<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['cin', 'image','permi' ,'nom', 'prenom', 'phone','adresse', 'user_id'];

}
