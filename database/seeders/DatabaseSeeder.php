<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Card;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Player 1',
            'email' => 'player1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('player1'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Player 2',
            'email' => 'player2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('player2'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //#1
        $card = new Card();
        $card->name = "Joe";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 1;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();

        //#2
        $card = new Card();
        $card->name = "Iris";
        $card->sex = "woman";
        $card->skin = "skin_black";
        $card->hair = "hair_blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();

        //#3
        $card = new Card();
        $card->name = "Jeanne";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_black";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_brown";
        $card->save();

        //#4
        $card = new Card();
        $card->name = "Mathilde";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 1;
        $card->eye = "eye_blue";
        $card->save();

        //#5
        $card = new Card();
        $card->name = "Yohann";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_black";
        $card->beard = 1;
        $card->mustach = 1;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();

        //#6
        $card = new Card();
        $card->name = "Roxane";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 1;
        $card->eye = "eye_blue";
        $card->save();

        //#7
        $card = new Card();
        $card->name = "Paul";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_bald";
        $card->beard = 0;
        $card->mustach = 1;
        $card->glasses = 1;
        $card->eye = "eye_grey";
        $card->save();

        //#8
        $card = new Card();
        $card->name = "Florent";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_red";
        $card->beard = 1;
        $card->mustach = 1;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();

        //#9
        $card = new Card();
        $card->name = "Anne-Marie";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_black";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 1;
        $card->eye = "eye_blue";
        $card->save();

        //#10
        $card = new Card();
        $card->name = "Anne-Claire";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_brown";
        $card->save();

        //#11
        $card = new Card();
        $card->name = "Corentin";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_black";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 1;
        $card->eye = "eye_blue";
        $card->save();

        //#12
        $card = new Card();
        $card->name = "Suzanne";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 1;
        $card->eye = "eye_green";
        $card->save();

        //#13
        $card = new Card();
        $card->name = "Antoinette";
        $card->sex = "woman";
        $card->skin = "skin_black";
        $card->hair = "hair_black";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();

        //#14
        $card = new Card();
        $card->name = "Yvette";
        $card->sex = "woman";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_brown";
        $card->save();

        //#15
        $card = new Card();
        $card->name = "Jacques";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 1;
        $card->glasses = 1;
        $card->eye = "eye_blue";
        $card->save();

        //#16
        $card = new Card();
        $card->name = "Axel";
        $card->sex = "man";
        $card->skin = "skin_black";
        $card->hair = "hair_black";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_brown";
        $card->save();

        //#17
        $card = new Card();
        $card->name = "Robin";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();

        //#18
        $card = new Card();
        $card->name = "Adrien";
        $card->sex = "man";
        $card->skin = "skin_white";
        $card->hair = "hair_dark blond";
        $card->beard = 0;
        $card->mustach = 0;
        $card->glasses = 0;
        $card->eye = "eye_blue";
        $card->save();
    }
}
