<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'society_id',
        'disease_history',
        'current_symptoms',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class , 'doctor_id', 'id');
    }

    public function society()
    {
        return $this->belongsTo(Society::class , 'society_id', 'id');
    }
}
