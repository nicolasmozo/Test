<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->integer('category_id');
            $table->string('product_type');
            $table->text('name');
            $table->text('slug');
            $table->string('regular_price')->nullable();
            $table->string('extend_price')->nullable();
            $table->text('preview_link')->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->text('download_file')->nullable();
            $table->string('download_file_type')->nullable();
            $table->text('download_link')->nullable();
            $table->longText('description')->nullable();
            $table->string('release_date')->nullable();
            $table->string('last_update_date')->nullable();
            $table->text('used_technology')->nullable();
            $table->text('file_type')->nullable();
            $table->string('high_resolution')->nullable();
            $table->text('cross_browser')->nullable();
            $table->string('documentation')->nullable();
            $table->string('layout')->nullable();
            $table->string('file_size')->nullable();
            $table->text('tags')->nullable();
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
