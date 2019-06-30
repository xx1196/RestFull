<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
     * Constante de estados
     */
    const PRODUCT_AVAILABLE = '1';
    const PRODUCT_NOT_AVAILABLE = '0';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'seller_id',
    ];

    public function isAvailable()
    {
        return $this->state == self::PRODUCT_AVAILABLE;
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
