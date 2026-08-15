<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $fillable = [
        'type', 'event', 'notifiable_id', 'recipient_id',
        'recipient_email', 'subject', 'status', 'error_message', 'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}
