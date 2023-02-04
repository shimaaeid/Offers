<?php

namespace App\Models;

use App\Observers\CountryObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $fillable = ['name','flag'];
    public $translatable = ['name'];

    public function cities(){
        return $this->hasMany(City::class);
    }

    public static function boot() {
        parent::boot();
        Country::observe(CountryObserver::class);
    }

    public function asJson($value){
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
