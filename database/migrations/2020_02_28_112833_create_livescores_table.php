<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivescoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livescores', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->string('league_name');
            $table->integer('home_id');
            $table->string('status');
            $table->string('home_name');
            $table->integer('id'); 
            $table->integer('competition_id');
            $table->integer('away_id');
            $table->string('ht_score');
            $table->date('added');
            $table->string('score');
            $table->string('competition_name');
            $table->integer('fixture_id');
            $table->string('away_name');
            $table->text('events');
            $table->string('scheduled');
            $table->string('et_score');
            $table->integer('league_id');
            $table->string('location')->nullable();
            $table->string('time');
            $table->date('last_changed');
            $table->string('ft_score');
            $table->string('outcomes_half_time')->nullable();
            $table->string('outcomes_full_time')->nullable();
            $table->string('outcomes_extra_time')->nullable();
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
        Schema::dropIfExists('livescores');
    }
}
