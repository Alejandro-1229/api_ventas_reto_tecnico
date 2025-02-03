<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

        public function sale()
        {
            return $this->belongsTo(Sale::class);
        }
    
        public function product()
        {
            return $this->belongsTo(Product::class);
        }

    protected $fillable = [
        'sale_id',
        'product_id',
        'cantidad',
        'precio_unitario',
        'sub_total'
    ];
}
