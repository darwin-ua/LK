<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finances extends Model
{
    protected $table = 'finance_reconciliation';

    protected $fillable = [
        'user_id',
        'client',
        'organization',
        'opening',
        'accrued',
        'paid',
        'closing',
        'period_from',
        'period_to',
        'created_at',
    ];

    public $timestamps = false;
}

