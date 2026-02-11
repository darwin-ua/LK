<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'user_id',
        'id_lk',
        'complaint_number',
        'complaint_date',
        'posted',
        'defect',
        'comment',
        'title',
    ];

    protected $casts = [
        'complaint_date' => 'datetime',
        'posted' => 'boolean',
    ];
}

