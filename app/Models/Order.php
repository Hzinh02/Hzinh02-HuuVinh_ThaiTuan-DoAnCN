<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $table = 'orders';
    protected $fillable = ['id_order', 'name', 'address', 'phone', 'status', 'email_user'];
    protected $keyType = 'string';
    public function getKeyName()
    {
        return 'id_order';
    }
}
