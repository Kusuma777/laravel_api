<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Available_vacine extends Model
{
    use HasFactory;

    public function spot()
    {
        return $this->hasOne(Spot::class , 'spot_id', 'id');
    }
}
