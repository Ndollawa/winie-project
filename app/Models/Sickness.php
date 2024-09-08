<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sickness extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function symptoms()
    {
        return $this->hasMany(Symptom::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }


    public static function withSymptoms($symptoms)
    {
        return static::whereHas('symptoms', function ($query) use ($symptoms) {
            $query->whereIn('name', $symptoms);
        })->get();
    }
}
