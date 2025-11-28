<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('job_applications')) {
            Schema::dropIfExists('job_applications');
        }
        
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_posting_id')->constrained('job_postings')->onDelete('cascade');
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('education')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('military_status')->nullable();
            $table->string('residence')->nullable();
            $table->string('desired_position')->nullable();
            $table->string('whatsapp_phone')->nullable();
            $table->text('about')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
