<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'filepath'];
    
    protected $casts = [
        'product_id'    =>  'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
