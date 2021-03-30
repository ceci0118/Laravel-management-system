<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailStatusType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['type'];

    public function mailMessages()
    {
        return $this->hasMany(MailMessage::class, $foreignKey = 'mail_status');
    }
}
