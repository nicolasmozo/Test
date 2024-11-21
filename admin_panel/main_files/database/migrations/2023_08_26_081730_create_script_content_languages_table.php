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
        Schema::create('script_content_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('script_id');
            $table->string('lang_code');
            $table->longText('regular_content')->nullable();
            $table->longText('extend_content')->nullable();
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
        Schema::dropIfExists('script_content_languages');
    }
};
