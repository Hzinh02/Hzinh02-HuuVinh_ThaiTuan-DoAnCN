<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    public $timestamps = false;
    protected $table = 'drink';
    protected $fillable = ['drink_id', 'drink_name', 'price', 'img', 'cat_id'];
    protected $keyType = 'string';
    public function getKeyName()
    {
        return 'drink_id';
    }
}
