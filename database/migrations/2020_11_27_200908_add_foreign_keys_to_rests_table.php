<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('rests', function(Blueprint $table)
		{
			$table->foreign('nailist_id', 'rests_ibfk_1')->references('id')->on('nailists')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('rests', function(Blueprint $table)
		{
			$table->dropForeign('rests_ibfk_1');
		});
	}

}
