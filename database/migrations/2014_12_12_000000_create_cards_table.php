<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Card;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('visible_player1')->default(true);
            $table->boolean('visible_player2')->default(true);
            $table->boolean('mustach')->default(false);
            $table->boolean('beard')->default(false);
            $table->boolean("glasses")->default(0);
            $table->enum('sex',Card::SEX)->default("man");
            $table->enum('hair',Card::HAIR)->default("black");
            $table->enum("eye", Card::EYE)->default("blue");
            $table->enum("skin", Card::SKIN)->default("white");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
