<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JobPosting extends Model
{
    // Route model binding by slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'shop_name',
        'shop_address',
        'whatsapp_phone',
        'status',
        'is_active',
        'approved_at',
        'published_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'approved_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_posting_id');
    }

    // Scopes
    public function scopeApprovedActive($query)
    {
        return $query->where('status', 'approved')
            ->where('is_active', true);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $slug = Str::slug($job->title);
                $count = static::where('slug', 'like', $slug . '%')->count();
                $job->slug = $count > 0 ? $slug . '-' . ($count + 1) : $slug;
            }
        });

        static::deleting(function ($job) {
            $job->applications()->delete();
        });
    }
}
