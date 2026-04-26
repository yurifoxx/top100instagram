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
        Schema::create('instagram_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('rank');
            $table->string('username')->unique();
            $table->string('full_name');
            $table->text('bio')->nullable();
            $table->unsignedBigInteger('followers_count')->default(0);
            $table->unsignedBigInteger('following_count')->default(0);
            $table->unsignedBigInteger('posts_count')->default(0);
            $table->string('avatar_url')->nullable();
            $table->string('profile_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('country')->default('BR');
            $table->smallInteger('rank_change')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_updated_at')->nullable();
            $table->timestamps();

            $table->index('rank');
            $table->index(['is_active', 'rank']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram_profiles');
    }
};
