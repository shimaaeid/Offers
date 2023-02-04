<?php

namespace App\Models;

use App\Observers\ShopOfferObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Shop extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes, HasTranslations;
    // use Authenticatable;

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

    public static function boot() {
        parent::boot();
        Shop::observe(ShopOfferObserver::class);

    }

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

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

}
