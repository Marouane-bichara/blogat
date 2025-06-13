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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('topic_id')->constrained('smart_topics');
            $table->string('title');
            $table->string('slug');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->longText('html_content');
            $table->string('cover_image_url');
            $table->enum('status', ['draft', 'published', 'exported'])->default('draft');
            $table->string('exported_to')->nullable();
            $table->string('exported_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
