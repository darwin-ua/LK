<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerManager extends Model
{
    use HasFactory;

    protected $table = 'lk_partner_managers';

    protected $guarded = [];

    public $timestamps = false;
}
