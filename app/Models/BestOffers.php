<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class BestOffers extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = ['shop_id', 'category_id', 'title', 'description', 'price', 'discount', 'priority','image_path'];
    public $translatable = ['title', 'description'];

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
