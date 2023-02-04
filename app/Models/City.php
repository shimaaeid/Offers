<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = ['name', 'location', 'country_id'];
    public $translatable = ['name'];
    protected $name;

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city(){
        return $this->hasMany(city::class, 'city_id');
    }


    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop','shop_cities','shop_id','city_id');
    }



}
