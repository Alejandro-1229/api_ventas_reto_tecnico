<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    protected $fillable = [
        'nombre',
        'type_of_id_id',
        'numero_identidad',
        'correo',
    ];
}
