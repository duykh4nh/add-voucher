<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeeModel extends Model
{
    use HasFactory;
    protected $table = 'voucher';
    protected $fillable = ['data', 'created_at', 'updated_at'];

}
