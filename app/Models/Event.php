<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $fillable = ['applicant_id', 'status_id'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, $foreignKey = 'applicant_id');
    }

    public function type()
    {
        return $this->belongsTo(StatusType::class, $foreignKey = 'status_id');
    }
}
