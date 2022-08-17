<?php

namespace App;

use App\Cart;
use App\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function carts()
    {
        return $this->BelongsToMany(Cart::class)->withPivot('quantity');
    }

    public function orders()
    {
        return $this->BelongsToMany(Order::class)->withPivot('quantity');
    }
}
