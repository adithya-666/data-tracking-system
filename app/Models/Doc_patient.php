<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_patient extends Model
{
    use HasFactory;

    protected $table = 'doc_patients';

    protected $fillable = [

        'patient_id',
        'doc_name',
        'doc_sub',
        'doc_user_sub',
        'doc_time_sub',
        'doc_ver',
        'doc_user_ver',
        'doc_time_ver',
        'doc_val',
        'doc_user_val',
        'doc_time_val',
        'doc_note_sub',
        'doc_note_ver',
        'doc_note_val'

    ];
}
