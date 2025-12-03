<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'slug')) {
                $table->string('slug')->unique()->after('name');
            }
        });

        // Backfill slugs for existing categories
        // Add "checkers" for validation and ensure id uniqueness before updating slugs
        $categories = DB::table('categories')->select('id', 'name')->get();

        // We'll make a checker array to keep track of existing slugs (just in case)
        $existingSlugs = DB::table('categories')->pluck('slug')->filter()->toArray();
        $slugChecker = array_flip($existingSlugs);

        foreach ($categories as $cat) {
            $base = Str::slug($cat->name ?? ('category-'.$cat->id));

            $slug = $base;
            $i    = 1;
            // Check using both DB and our checker to avoid even temporary collision
            while (
                isset($slugChecker[$slug]) ||
                DB::table('categories')->where('slug', $slug)->where('id', '!=', $cat->id)->exists()
            ) {
                $slug = $base . '-' . $i++;
            }
            // Update and mark slug as used
            DB::table('categories')->where('id', $cat->id)->update(['slug' => $slug]);
            $slugChecker[$slug] = true;
        }
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};




















