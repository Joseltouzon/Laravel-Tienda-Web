<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Product;

class PanelProduct extends Product
{
    use HasFactory;

        /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        //
    }
}
