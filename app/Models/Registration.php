<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'gender',
        'nationality',
        'country_of_residence',
        'age',
        'preferred_language',
        'educational_qualification',
        'current_job',
        'workplace',
        'type_of_work',
        'id_number',
        'id_issue_date',
        'id_expiry_date',
        'id_photo',
        'q1_answer',
        'q1_text',
        'q2_answer',
        'q2_text',
        'q3_answer',
        'q3_text',
        'q4_answer',
        'q4_text',
        'participation_type',
        'participation_type_file',
    ];
}
