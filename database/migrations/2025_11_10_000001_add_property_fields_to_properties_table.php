<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'property_type')) {
                $table->string('property_type')->after('description');
                $table->index('property_type');
            }
            if (!Schema::hasColumn('properties', 'property_status')) {
                $table->string('property_status')->default('active')->after('property_type');
                $table->index('property_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'property_status')) {
                $table->dropIndex(['property_status']);
                $table->dropColumn('property_status');
            }
            if (Schema::hasColumn('properties', 'property_type')) {
                $table->dropIndex(['property_type']);
                $table->dropColumn('property_type');
            }
        });
    }
};











