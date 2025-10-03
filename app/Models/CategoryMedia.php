<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryMedia extends Model
{
    protected $fillable = ['category_id', 'url', 'is_primary'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
