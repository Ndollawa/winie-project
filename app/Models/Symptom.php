<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'sickness_id', 'description'];

    public function sickness()
    {
        return $this->belongsTo(Sickness::class);
    }
}
