<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    use HasFactory;

    public function available_vacine()
    {
        return $this->hasOne(Available_vacine::class , 'spot_id', 'id');
    }
}
