<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Property extends Model
{
    public const TYPE_SALE = 'sale';
    public const TYPE_RENT = 'rent';

    public const STATUS_INACTIVE = 'inactive';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_SOLD = 'sold';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'property_type',
        'property_status',
        'price',
        'location',
        'whatsapp_phone',
        'published_at',
        'is_accepted',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'price' => 'decimal:2',
        'is_accepted' => 'boolean',
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

    public function scopePubliclyVisible($query)
    {
        return $query->whereIn('property_status', [self::STATUS_ACTIVE, self::STATUS_SOLD]);
    }

    public function isPubliclyVisible(): bool
    {
        return in_array($this->property_status, [self::STATUS_ACTIVE, self::STATUS_SOLD], true);
    }

    public function getTypeLabel(): string
    {
        return $this->property_type === self::TYPE_RENT
            ? __('general.rent')
            : __('general.sale');
    }

    public function getStatusLabel(): ?string
    {
        if ($this->property_status === self::STATUS_INACTIVE) {
            return __('general.status_inactive');
        }
        if ($this->property_status === self::STATUS_ACTIVE) {
            return __('general.status_active');
        }
        if ($this->property_status === self::STATUS_SOLD) {
            // Different text depending on type: sold for sale, rented for rent
            return $this->property_type === self::TYPE_RENT
                ? __('general.status_rented')
                : __('general.status_sold');
        }
        return null;
    }
}
