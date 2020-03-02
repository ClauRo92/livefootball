<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('_id')->unique();
            $table->date('date');
            $table->string('time');
            $table->string('round');
            $table->string('home_name');
            $table->string('away_name');
            $table->string('location');
            $table->integer('league_id');
//            $table->string('league_name')->default('a');
//            $table->integer('league_country_id')->default(0);
            $table->integer('competition_id');
            $table->string('competition_name');
            $table->integer('home_id');
            $table->integer('away_id');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
