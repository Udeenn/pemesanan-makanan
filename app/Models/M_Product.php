<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\M_Transaction;

class M_Product extends Model
{
    use HasFactory;

    public function transactions(){
        return $this->hasMany(M_Transaction::class);
    }
    
    protected $table = 'tb_product';
    protected $primaryKey = 'id_product';
    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'image',
    ];
}
