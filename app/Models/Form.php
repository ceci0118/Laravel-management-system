<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public $fillable = ['form_path', 'formable_id', 'formable_type', 'signature_id'];

    public function formable()
    {
        return $this->morphTo();
    }

    public function signature()
    {
        return $this->hasOne(Signature::class, $foreignKey = 'id', $localKey = 'signature_id');
    }
}
