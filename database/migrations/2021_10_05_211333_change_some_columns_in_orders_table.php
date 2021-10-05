<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSomeColumnsInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('notice')->nullable()->change();
            $table->unsignedBigInteger('discount_id')->nullable()->change();
            $table->string('discount_code')->nullable()->change();
            $table->decimal('discount_value', 10, 2)->nullable()->change();
            $table->dateTime('date_order')->useCurrent()->change();
            $table->dateTime('date_send')->nullable()->change();
            $table->dateTime('date_pay')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
