<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyMedia extends Model
{
    protected $fillable = ['property_id', 'url', 'is_primary'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getTypeAttribute()
    {
        $extension = strtolower(pathinfo($this->url, PATHINFO_EXTENSION));
        return in_array($extension, ['mp4', 'mov', 'avi', 'wmv', 'flv', 'webm']) ? 'video' : 'image';
    }
}
