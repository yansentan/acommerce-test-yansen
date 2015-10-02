<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->integer('category_id')->unsigned();
			$table->text('address');
			$table->string('phone', 15);
			$table->string('email');
            $table->timestamps();
			
			$table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers', function (Blueprint $table) {
			$table->dropForeign('sellers_category_id_foreign');
		});
		
		Schema::drop('sellers');
    }
}
