<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key'); // e.g., site.logo, seo.home.title
            $table->string('locale', 10)->nullable(); // null for non-localized settings
            $table->string('type', 20)->default('string'); // string|text|image
            $table->text('value')->nullable(); // value or storage path
            $table->timestamps();
            $table->unique(['key', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};


