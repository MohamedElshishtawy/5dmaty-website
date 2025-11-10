<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // e.g., ar, en
            $table->string('name', 100);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_rtl')->default(true);
            $table->timestamps();
        });

        // Seed default Arabic language
        DB::table('languages')->insert([
            'code' => 'ar',
            'name' => 'العربية',
            'is_active' => true,
            'is_rtl' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};


