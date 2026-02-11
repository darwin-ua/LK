<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $guarded = [];

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



