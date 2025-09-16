<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('created_datetime')->nullable();
            $table->string('title_article')->nullable();
            $table->unsignedBigInteger('id_article')->nullable();
            $table->string('activity')->nullable();
            $table->string('user_name')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('roles')->nullable();
            $table->string('status')->nullable();
            $table->string('scheduled_time')->nullable();
            $table->string('article_created_at')->nullable();
            $table->string('article_published_at')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
