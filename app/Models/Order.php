<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    // Relasi: Satu order punya banyak item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
