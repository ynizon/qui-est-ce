<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('player1_id')->nullable();
            $table->unsignedBigInteger('player2_id')->nullable();
            $table->unsignedBigInteger('player')->nullable();
            $table->unsignedBigInteger('winner')->nullable();
            $table->unsignedBigInteger('card1_id')->nullable();
            $table->unsignedBigInteger('card2_id')->nullable();
            $table->string('name');
            $table->text('informations')->comment('Score during the game [Player1=>viewable cards, Player2=>viewable cards]');
            $table->text('cards')->comment('All cards in the game [cardId=>card]');
            $table->timestamps();

            $table->foreign('player1_id')->references('id')->on('users');
            $table->foreign('player2_id')->references('id')->on('users');
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
