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
            $table->float('original_amount');
            $table->float('discounted_amount');
            $table->unsignedBigInteger('coupon_id');
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->integer('coupen_type');
            $table->integer('discount');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('customers');
            $table->string('order_date');
            $table->integer('payment_status')->default(1)->comment('1=>not paid,2=>paid');
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
