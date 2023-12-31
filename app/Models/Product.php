<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'sku',
        'price',
        'tags',
        'thumbnail',
        'description',
        'discount',
        'category_id',
        'quantity',
        'media',
        'discount',
        'variantions',
        'publish_date',
        'created_by',
        'updated_by',
        'deleted_by',
        'slug',
        'status'
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }


    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }
}
