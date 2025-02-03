<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'sale_details')
                    ->withPivot('cantidad', 'precio_unitario', 'sub_total')
                    ->withTimestamps();
    }

    protected $fillable = [
        'sku',
        'nombre',
        'descripcion',
        'precio_unitario',
        'stock',
        'state_id'
    ];
}
