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
        Schema::create('ranking_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('instagram_profiles')->onDelete('cascade');
            $table->unsignedSmallInteger('rank');
            $table->unsignedBigInteger('followers_count');
            $table->timestamp('recorded_at');
            $table->index(['profile_id', 'recorded_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking_histories');
    }
};
