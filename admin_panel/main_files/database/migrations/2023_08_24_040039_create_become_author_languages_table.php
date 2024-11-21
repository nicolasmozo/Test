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
        Schema::create('become_author_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('become_id');
            $table->string('lang_code');
            $table->string('title')->nullable();
            $table->string('header1')->nullable();
            $table->string('header2')->nullable();
            $table->text('description')->nullable();
            $table->string('name')->nullable();
            $table->string('desgination')->nullable();
            $table->string('item1')->nullable();
            $table->string('item2')->nullable();
            $table->string('item3')->nullable();
            $table->string('item4')->nullable();
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
        Schema::dropIfExists('become_author_languages');
    }
};
