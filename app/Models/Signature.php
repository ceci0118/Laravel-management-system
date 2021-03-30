<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    public $fillable = ['signature_path'];

    public function form()
    {
        return $this->belongsTo(Form::class, $foreighKey = 'id', $localKey = 'signature_id');
    }
}
