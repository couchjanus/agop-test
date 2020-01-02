<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
// use App\ImageCategory;

class Category extends Model
{
    // use EagerLoadPivotTrait;

    protected $fillable = [
        'name'
    ];

    public function products()
    {
        // return $this->belongsToMany(Product::class);
        return $this->belongsToMany(Product::class)
        ->withPivot('product_id'); // this is needed to query the relation `category`
        //->using(ImageCategory::class);
    }
}
