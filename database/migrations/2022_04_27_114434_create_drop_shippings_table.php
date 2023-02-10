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
        Schema::create('drop_shippings', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->string('order_no');
            $table->string('customer');
            $table->string('mobile');
            $table->string('merchant');
            $table->string('product');
            $table->string('pickup_address');
            $table->string('delivery_address');
            $table->string('date');
            $table->string('status');
            $table->string('payment_status');
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
        Schema::dropIfExists('drop_shippings');
    }
};
