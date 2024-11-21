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
        Schema::create('become_authors', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('header1')->nullable();
            $table->text('header2')->nullable();
            $table->text('header3')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('item1')->nullable();
            $table->string('icon1')->nullable();
            $table->string('item2')->nullable();
            $table->string('icon2')->nullable();
            $table->string('item3')->nullable();
            $table->string('icon3')->nullable();
            $table->string('item4')->nullable();
            $table->string('icon4')->nullable();
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
        Schema::dropIfExists('become_authors');
    }
};
