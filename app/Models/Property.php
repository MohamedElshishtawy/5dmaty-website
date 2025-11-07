<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Property extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'location',
        'whatsapp_phone',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function medias()
    {
        return $this->hasMany(PropertyMedia::class);
    }

    // Auto-generate slug from title
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title);
            }
        });

        static::deleting(function ($property) {
            // Delete associated media files from storage
            foreach ($property->medias as $media) {
                if (Storage::disk('public')->exists($media->url)) {
                    Storage::disk('public')->delete($media->url);
                }
            }
            // Delete associated media records from database
            $property->medias()->delete();
        });
    }
}
