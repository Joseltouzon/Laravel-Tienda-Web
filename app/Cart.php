<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');

    }

    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }
}
