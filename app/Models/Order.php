<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'time',
        'type',
        'payment',
        'count',
        'address',
        'furniture_id',
        'user_id',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the furniture that is ordered.
     */
    public function furniture()
    {
        return $this->belongsTo(Furniture::class);
    }

    /**
     * Calculate the total price of the order.
     */
    public function getTotalPrice()
    {
        return $this->furniture->price * $this->count;
    }
}
