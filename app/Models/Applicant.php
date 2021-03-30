<?php

namespace App\Models;

use App\Models\Guardian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;

    public $fillable = ['first', 'last', 'dob', 'email', 'applicant_type', 'applicant_id', 'season_id', 'status'];

    public function type()
    {
        return $this->belongsTo(ApplicantType::class, $foreignKey = 'applicant_type');
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function statusType()
    {
        return $this->belongsTo(StatusType::class, $foreignKey = 'status');
    }

    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }

    public function mailMessages()
    {
        return $this->hasMany(MailMessage::class);
    }


    //-------------Attributes------------//
    public function getFullNameAttribute()
    {
        return $this->first . " " . $this->last;
    }

    protected $casts = [
        'dob' => 'date'
    ];
}
