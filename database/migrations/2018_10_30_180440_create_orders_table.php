<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->decimal('price', 8, 2)->unsigned();
            $table->decimal('prepayment', 8, 2)->unsigned();
            $table->timestamp('finished_at');
            $table->integer('delivery_id')->unsigned();
            $table->timestamp('delivery_at');
            $table->text('info')->nullable();
            $table->boolean('is_need_cake')->default(0);
            $table->text('subject')->nullable();
            $table->text('result')->nullable();
            $table->boolean('is_in_catalog')->default(0);
            $table->integer('status_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('delivery_id')
                ->references('id')
                ->on('deliveries');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
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
