<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    use HasFactory;
    protected $fillable = [
        'regional_id',
        'id_card_number',
        'name',
        'born_date',
        'gender',
        'address',
        'token',
        'password',
    ];

    public function regional()
    {
        return $this->hasOne(Regional::class , 'id' , 'regional_id');
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class , 'society_id', 'id');
    }


}
