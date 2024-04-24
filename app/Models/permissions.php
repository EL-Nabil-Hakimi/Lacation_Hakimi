<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permissions extends Model
{
    use HasFactory;


    protected $table = "permission_role";
    protected $fillable = [
        'role_id',
        'permission_id',
    ];
    public function role()
    {
        return $this->belongsTo(Roles::class);
    }

    public function permissionName()
    {
        return $this->belongsTo(PermissionsName::class ,'permission_id');
    }
    
}
