<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'cover', 'parent'];

    public function category()
    {
        return Category::find($this->parent);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
