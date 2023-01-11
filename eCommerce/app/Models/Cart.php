<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_qty',
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','prod_id','id');
    }
}
