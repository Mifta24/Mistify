<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'price',
        'stock',
        'sizes',
        'default_size',
        'brand',
        'concentration',
        'scent_notes',
        'gender',
        'fragrance_family',
        'is_featured',
        'is_new',
        'is_bestseller',
        'is_active',
        'category_id'
    ];

    protected $casts = [
        'sizes' => 'array',
        'scent_notes' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_bestseller' => 'boolean'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot(['quantity', 'price', 'subtotal']);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Scopes
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Helper Methods

    // Helper methods for sizes
    public function getPriceForSize($size)
    {
        if (isset($this->sizes[$size])) {
            return $this->sizes[$size];
        }

        return $this->price; // Default price
    }

    public function getAvailableSizes()
    {
        return array_keys($this->sizes ?: []);
    }
    
    public function hasStock($quantity = 1)
    {
        return $this->stock >= $quantity;
    }

    public function decreaseStock($quantity = 1)
    {
        if ($this->hasStock($quantity)) {
            $this->decrement('stock', $quantity);
            return true;
        }
        return false;
    }

    public function increaseStock($quantity = 1)
    {
        $this->increment('stock', $quantity);
    }
}
