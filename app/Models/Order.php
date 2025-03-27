<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 
    
    protected $fillable = [
        'id',
        'ordered_products',
        'name', 
        'phone',  
        'address',
        'district',
        'total_amount',
        'pay_method',
        'card_num', 
        'expire_date',
        'card_name',
        'ordered_quantity',

    ];
}  

