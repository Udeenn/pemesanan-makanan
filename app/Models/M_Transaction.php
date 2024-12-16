<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Transaction extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(M_Product::class);
    }

    protected $table = 'tb_transaction';
    protected $primaryKey = 'id_trasaction';
    protected $fillable = [
        'buyerName',
        'product_id',
        'product_price',
        'total',
    ];
}
