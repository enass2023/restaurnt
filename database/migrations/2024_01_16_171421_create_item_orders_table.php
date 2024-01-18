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
        Schema::create('item_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
         
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('item_id')
            ->references('id')->on('items')->onDelete('SET NULL');

            $table->foreign('order_id')
            ->references('id')->on('orders')->onDelete('cascade');
            $table->unique(["order_id","item_id"]);
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
        Schema::dropIfExists('item_orders');
    }
};
