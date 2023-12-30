<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = 'category';
    protected $fillable = ['cat_id', 'cat_name'];
    protected $keyType = 'string';
    public function getKeyName()
    {
        return 'cat_id';
    }
}
