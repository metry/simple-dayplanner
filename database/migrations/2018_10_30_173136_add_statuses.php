<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('statuses')->insert(array(
            'name' => 'Заказ принят',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        DB::table('statuses')->insert(array(
            'name' => 'Выполнен, ждет доставки',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        DB::table('statuses')->insert(array(
            'name' => 'Заказ отдан',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('statuses')->where('name', '=', 'Заказ принят')->delete();
        DB::table('statuses')->where('name', '=', 'Выполнен, ждет доставки')->delete();
        DB::table('statuses')->where('name', '=', 'Заказ отдан')->delete();
    }
}
