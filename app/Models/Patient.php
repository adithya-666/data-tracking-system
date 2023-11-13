<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $with = ['Doc_patient'];

    public function Doc_patient()
    {
        return $this->belongsTo('App\Models\Doc_patient', 'id', 'patient_id');
    }

    

    protected $fillable = [

        'no_sep',
        'birthdate',
        'gender',
        'medrec',
        'patient_name',
        'room_id',
        'no_order',
        'date_in',
        'date_out',
        'status_submission',
        'status_ver',
        'status_val',
        'status_grouping',
        'time_submission',
        'time_ver',
        'time_val',
        'time_grouping',
        'note_sub',
        'note_admin',
        'note_jkn',
        'note_ver',
        'note_val',
        'note_grouping',
        'created_at',
        'update_at',
        'status_revisi',
        'note_revisi',
        'time_revisi'

    ];
}
