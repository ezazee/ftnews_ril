<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('gambar')->nullable();
            $table->text('image_caption')->nullable();
            $table->text('short_description')->nullable();
            $table->string('slug')->nullable();
            $table->enum('status', ['draft', 'schedule', 'publish']);
            $table->string('headline')->nullable();
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->string('keyword')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
