<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoSetting extends Model
{
    use HasFactory;

    protected $fillable = ['forceUpdate', 'lastBuild', 'website', 'whatsApp',
    'phone', 'snap', 'Instagram', 'ticktock', 'policy', 'android', 'ios'];
}
