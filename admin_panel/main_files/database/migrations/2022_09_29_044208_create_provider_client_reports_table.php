<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderClientReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_client_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('client_id');
            $table->integer('provider_id');
            $table->string('report_from');
            $table->string('report_to');
            $table->text('report');
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
        Schema::dropIfExists('provider_client_reports');
    }
}
