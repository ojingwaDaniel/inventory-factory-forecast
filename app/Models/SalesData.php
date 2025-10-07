<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesData extends Model
{
    //
    protected $fillable = ["product_id", "month", "units_sold"];
}
