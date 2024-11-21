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
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->text('why_choose_title1');
            $table->text('why_choose_title2');
            $table->text('why_choose_item1_icon');
            $table->text('why_choose_item2_icon');
            $table->text('why_choose_item3_icon');
            $table->text('why_choose_item1_title');
            $table->text('why_choose_item2_title');
            $table->text('why_choose_item3_title');
            $table->text('why_choose_home1_background');
            $table->text('offer_title1');
            $table->text('offer_title2');
            $table->text('offer_home1_background');
            $table->text('offer_home1_foreground1');
            $table->text('offer_home1_foreground2');
            $table->text('offer_home2_background');
            $table->text('offer_home3_background');
            $table->text('counter1_value');
            $table->text('counter2_value');
            $table->text('counter3_value');
            $table->text('counter1_title');
            $table->text('counter2_title');
            $table->text('counter3_title');
            $table->text('counter1_description');
            $table->text('counter2_description');
            $table->text('counter3_description');
            $table->text('counter_item1_title');
            $table->text('counter_item1_description');
            $table->text('counter_item1_link');
            $table->text('counter_item1_icon');
            $table->text('counter_item2_title');
            $table->text('counter_item2_description');
            $table->text('counter_item2_link');
            $table->text('counter_item2_icon');
            $table->text('counter_home1_background');
            $table->text('counter_home2_background');
            $table->text('app_title1');
            $table->text('app_title2');
            $table->text('app_title3');
            $table->text('app_description');
            $table->text('app_play_store_link');
            $table->text('app_apple_store_link');
            $table->text('app_home1_foreground');
            $table->text('app_home2_foreground');
            $table->text('app_home3_foreground1');
            $table->text('app_home3_foreground2');
            $table->text('app_home1_background');
            $table->text('app_home2_background');
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
        Schema::dropIfExists('homepages');
    }
};
