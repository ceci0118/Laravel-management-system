<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['type'];

    public function applicants()
    {
        return $this->hasMany(Applicant::class, $foreignKey = 'applicant_type');
    }
}
