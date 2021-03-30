<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;

    public $fillable = ['title', 'body', 'user_id'];

    public function mailMessages()
    {
        return $this->hasMany(MailMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
