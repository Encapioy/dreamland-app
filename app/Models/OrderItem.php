<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    // Shortcut/Helper untuk mempermudah pemanggilan nama lengkap di View
    // Cara pakai: $item->product_name
    public function getProductNameAttribute()
    {
        return $this->variant->product->name . ' (' . $this->variant->name . ')';
    }
}
