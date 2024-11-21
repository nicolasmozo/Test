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
        if (Schema::hasTable('provider_withdraws')) {
            Schema::table('provider_withdraws', function (Blueprint $table) {
                $table->text('feedback')->nullable()->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('provider_withdraws')) {
            Schema::table('provider_withdraws', function (Blueprint $table) {
                $table->dropColumn('feedback');
            });
        }
    }
};
