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
        //
        Schema::table('users', function (Blueprint $table) {
                $table->enum('provider', ['local', 'google'])->default('local');
                $table->foreignId('plan_id')->constrained('plans');
                $table->dateTime('subscription_expires_at')->nullable();
                $table->integer('article_quota_remaining')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['provider', 'plan_id', 'subscription_expires_at', 'article_quota_remaining']);
        });
    }
};
