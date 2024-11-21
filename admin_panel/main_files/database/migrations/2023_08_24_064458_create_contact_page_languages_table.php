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
        Schema::create('contact_page_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('contact_id');
            $table->string('lang_id');
            $table->string('title1')->nullable();
            $table->string('title2')->nullable();
            $table->string('time')->nullable();
            $table->string('off_day')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('contact_page_languages');
    }
};
