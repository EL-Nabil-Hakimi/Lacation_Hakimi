<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class manager extends Model
{
    use HasFactory;

    protected $fillable = ['cin', 'image', 'nom', 'prenom', 'phone', 'user_id'];

    public function role(){
        return $this->belongsTo(Roles::class);
    }
    

    
    
}
