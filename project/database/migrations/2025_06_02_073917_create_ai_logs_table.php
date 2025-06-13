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
        Schema::create('ai_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('topic_id')->nullable()->constrained('smart_topics');
            $table->foreignId('article_id')->nullable()->constrained('articles');
            $table->enum('action_type', ['topic_suggestion', 'article_generation']);
            $table->text('prompt');
            $table->integer('output_length');
            $table->integer('tokens_used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_logs');
    }
};
