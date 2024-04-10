<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    public function ProductVariantItem(){
        return $this->hasMany(ProductVariantItem::class);
    }
}
