<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
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
        'image',
        'seller_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function isAvailable()
    {
        return $this->status == self::PRODUCT_AVAILABLE;
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
