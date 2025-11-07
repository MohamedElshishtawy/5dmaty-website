<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'education',
        'marital_status',
        'military_status',
        'residence',
        'desired_position',
        'whatsapp_phone',
        'about',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'age' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }
}
