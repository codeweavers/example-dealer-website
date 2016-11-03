<?php namespace Cw\StockManagement\Updates;

use October\Rain\Database\Updates\Migration;
use October\Rain\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('cw_stock_vehicles', function($table)
        {
            $table->increments('id');
            $table->string('email', 255);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('cw_stock_vehicles');
    }
}