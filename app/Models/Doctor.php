<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'name',

    // ];

    public function consultation()
    {
        return $this->hasOne(Consultation::class , 'doctor_id', 'id');
    }
}
