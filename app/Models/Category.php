<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = ['name', 'image_path'];
    public $translatable = ['name'];

    
    public function shops(){
        return $this->hasMany(Shop::class);
    }

    public function topLikedOffers(){
        return $this->hasMany(Offers::class);
    }


    public function bestOffers(){
        return $this->hasMany(BestOffers::class);
    }
}
