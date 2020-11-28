<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCancelWaitingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cancel_waitings', function(Blueprint $table)
		{
			$table->foreign('menu_id', 'cancel_waitings_ibfk_1')->references('id')->on('menus')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cancel_waitings', function(Blueprint $table)
		{
			$table->dropForeign('cancel_waitings_ibfk_1');
		});
	}

}
