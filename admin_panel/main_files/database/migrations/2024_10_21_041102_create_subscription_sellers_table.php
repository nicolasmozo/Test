<?php

use App\Constants\Status;
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
        Schema::create('subscription_sellers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('pricing_plan_id');
            $table->string('plan_name');
            $table->string('plan_type');
            $table->double('plan_price')->default(0);
            $table->string('expired_time');
            $table->integer('upload_limit');
            $table->string('transaction_id')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('payment_method');
            $table->tinyInteger('payment_status')->default(Status::PENDING);
            $table->tinyInteger('status')->default(Status::PENDING_SUBSCRIPTION);
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
        Schema::dropIfExists('subscription_sellers');
    }
};
