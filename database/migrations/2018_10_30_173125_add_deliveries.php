<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('deliveries')->insert(array(
            'name' => 'Самовывоз',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        DB::table('deliveries')->insert(array(
            'name' => 'Курьерская доставка',
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
        DB::table('deliveries')->where('name', '=', 'Самовывоз')->delete();
        DB::table('deliveries')->where('name', '=', 'Курьерская доставка')->delete();
    }
}
