<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    protected $table = 'orders_detail';
    protected $fillable = ['id_order', 'id_drink', 'price', 'quantity', 'subtotal'];
    protected $keyType = 'string';
    public function getKeyName()
    {
        return 'id_order';
    }
}
