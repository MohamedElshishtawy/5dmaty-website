<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

    public function medias()
    {
        return $this->hasMany(CategoryMedia::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    // boot delete
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $base = \Illuminate\Support\Str::slug($category->name);
                $slug = $base;
                $i = 1;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . ++$i;
                }
                $category->slug = $slug;
            }
        });

        static::deleting(function ($category) {
            // Delete associated media files from storage
            foreach ($category->medias as $media) {
                if (Storage::exists($media->url)) {
                    Storage::delete($media->url);
                }
            }
            // Delete associated media records from database
            $category->medias()->delete();
        });
    }

}
