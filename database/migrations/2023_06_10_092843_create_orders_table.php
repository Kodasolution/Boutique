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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('tva')->default(0);
            $table->double('price_without_tva');
            $table->double('price_with_tva');
            $table->double('price_total');
            $table->string("coupon")->nullable();
            $table->text("note")->nullable();
            $table->string("currency")->default('BIF');
            $table->timestamp("paymentDate")->nullable();
            $table->string('status')->default('unpaid');
            $table->foreign('user_id')->references('id')->on('users');
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
};
