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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail');
            $table->text('content');
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('news_category_id')->nullable(); // Foreign key column
            $table->timestamps();

            $table->foreign('news_category_id')->references('id')->on('news_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['news_category_id']);
        });
        Schema::dropIfExists('news');
    }
};
