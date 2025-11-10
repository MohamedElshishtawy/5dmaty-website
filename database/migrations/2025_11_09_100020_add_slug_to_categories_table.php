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
        $categories = DB::table('categories')->select('id', 'name')->get();
        foreach ($categories as $cat) {
            $base = Str::slug($cat->name ?? ('category-'.$cat->id));
            $slug = $base;
            $i = 1;
            while (DB::table('categories')->where('slug', $slug)->exists()) {
                $slug = $base . '-' . ++$i;
            }
            DB::table('categories')->where('id', $cat->id)->update(['slug' => $slug]);
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




