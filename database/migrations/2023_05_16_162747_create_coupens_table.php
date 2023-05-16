<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon')->unique();
            $table->integer('coupon_type')->comment('1=>fixed,2=>percent');
            $table->float('type_val_fixed')->nullable();
            $table->float('type_val_percent')->nullable();
            $table->string('valid_from');
            $table->string('valid_to');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('status')->default(1)->comment('1=>Active,2=>inactive');
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
        Schema::dropIfExists('coupens');
    }
}
