<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ImageCategory extends Pivot
{
    protected $table = 'product_images';

    public function images()
    {
        return $this->belongsTo(ProductImage::class);
    }
}