<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopCities extends Model
{
    use HasFactory;

    protected $fillable = ['shop_id', 'city_id'];
    protected $table = 'shop_cities';


}
