<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'opening_hours',
        'location',
        'location_url',
        'whatsapp',
        'insta',
        'snap',
        'web_site',
        'shoptype_id',
        'months',
        'category_id',
        'packagetype_id',
        'description',
        'profile_path',
        'cover_path',
        'active',
        'watched'

    ];
    public $translatable = ['name', 'opening_hours', 'location', 'description'];

    // public static function boot() {
    //     parent::boot();
    //     Admins::observe(ShopOfferObserver::class);

    // }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function offers(){
        return $this->hasMany(Offers::class);
    }


    public function shopType(){
        return $this->belongsTo(ShopType::class, 'shoptype_id');
    }

    public function packageType(){
        return $this->belongsTo(PackageType::class, 'packagetype_id');
    }

    public function cities()
    {
        return $this->belongsToMany(City::class, 'shop_cities');
    }


}
