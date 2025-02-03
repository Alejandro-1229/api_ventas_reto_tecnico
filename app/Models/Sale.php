<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_details')
                    ->withPivot('cantidad', 'precio_unitario', 'sub_total')
                    ->withTimestamps();
    }

    protected $fillable = [
        'codigo',
        'client_id',
        'user_id',
        'monto_total',
        'fecha_hora_venta'
    ];
}
