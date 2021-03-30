<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailMessage extends Model
{
    use HasFactory;

    public $fillable = ['applicant_id', 'mail_template_id', 'subject', 'from', 'to', 'cc', 'content', 'mail_status'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class, $foreignKey = 'applicant_id');
    }

    public function mailTemplate()
    {
        return $this->belongsTo(MailTemplate::class);
    }

    public function mailStatus()
    {
        return $this->belongsTo(MailStatusType::class, $foreignKey = 'mail_status');
    }
}