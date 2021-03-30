<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    public $fillable = ['first', 'last', 'email'];

    public function applicants()
    {
        return $this->belongsToMany(Applicant::class);
    }

    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }
}
