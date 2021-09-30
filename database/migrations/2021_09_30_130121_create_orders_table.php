<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('email')->nullable(false);
            $table->char('delivery_type',4)->nullable(false);
            $table->foreign('delivery_type')->references('type')->on('delivery_types');
            $table->string('address');
            $table->string('notice');
            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')->references('id')->on('discounts');
            $table->string('discount_code');
            $table->decimal('discount_value', 10, 2);
            $table->dateTime('date_order')->nullable(false);
            $table->dateTime('date_send');
            $table->dateTime('date_pay');
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
        Schema::dropIfExists('orders');
    }
}
