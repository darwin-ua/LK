<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'user_id',
        'paid',
        'amount',
        'status',
        'status_1c',
        'token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'amount' => 'decimal:2',
        'paid' => 'boolean',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'order_id', 'id');
    }
}



