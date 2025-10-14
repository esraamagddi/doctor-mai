<?php

namespace Solutions\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'contact_messages';

    protected $fillable = [
        'name','email','phone','subject','message','meta','attachments','is_read','status'
    ];

    protected $casts = [
        'meta'        => 'array',
        'attachments' => 'array',
        'is_read'     => 'boolean',
        'status'      => 'integer',
    ];

}
