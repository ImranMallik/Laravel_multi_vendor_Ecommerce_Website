<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function vendorprofile()
    {
        return $this->belongsTo(VendorProfile::class, 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImageGallery()
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function ProductVariat()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
