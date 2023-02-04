<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = ['shop_id', 'category_id', 'title', 'description', 'price', 'discount', 'image_path', 'deadline'];
    public $translatable = ['title', 'description'];

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'shop_cities');
    }

    public function shops(){
        return $this->hasMany(Shop::class);
    }

    public function shopType(){
        return $this->belongsTo(ShopType::class, 'shoptype_id');
    }
}
