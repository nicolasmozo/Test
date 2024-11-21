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
        Schema::create('homepage_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('home_id');
            $table->string('lang_code');
            $table->string('why_choose_title1')->nullable();
            $table->string('why_choose_title2')->nullable();
            $table->string('why_choose_item1_title')->nullable();
            $table->string('why_choose_item2_title')->nullable();
            $table->string('why_choose_item3_title')->nullable();
            $table->string('why_choose_home3_item1_title')->nullable();
            $table->string('why_choose_home3_item2_title')->nullable();
            $table->string('why_choose_home3_item3_title')->nullable();
            $table->string('why_choose_home3_item1_desc')->nullable();
            $table->string('why_choose_home3_item2_desc')->nullable();
            $table->string('why_choose_home3_item3_desc')->nullable();
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
        Schema::dropIfExists('homepage_languages');
    }
};
