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
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('list_category_id')->constrained()->onDelete('cascade');
            $table->string('name', 255);
            $table->text('comment')->nullable();
            $table->string('url', 255)->nullable();
            $table->integer('rating')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->tinyInteger('list_type')->comment('0=行きたい, 1=行った');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lists');
    }
};
