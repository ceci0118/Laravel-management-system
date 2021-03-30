<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['type'];

    public function events()
    {
        return $this->hasMany(Event::class, $foreignKey = 'status_id');
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class, $foreignKey = 'status');
    }
}
