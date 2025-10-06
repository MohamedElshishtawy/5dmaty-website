<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function medias()
    {
        return $this->hasMany(CategoryMedia::class);
    }

    // boot delete
    protected static function boot()
    {
        parent::boot();

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
