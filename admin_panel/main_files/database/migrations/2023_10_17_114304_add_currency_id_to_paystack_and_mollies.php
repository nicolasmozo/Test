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
        Schema::table('paystack_and_mollies', function (Blueprint $table) {
            $table->integer('paystack_currency_id')->nullable();
            $table->integer('mollie_currency_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paystack_and_mollies', function (Blueprint $table) {
            $table->dropColumn('paystack_currency_id');
            $table->dropColumn('mollie_currency_id');
        });
    }
};
