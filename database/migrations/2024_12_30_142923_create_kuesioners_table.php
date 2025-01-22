<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuesionersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioners', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kepuasan_1');
            $table->string('kepuasan_2');
            $table->string('kepuasan_3');
            $table->string('kepuasan_4');
            $table->string('kepuasan_5');
            $table->string('kepuasan_6');
            $table->string('kepentingan_1');
            $table->string('kepentingan_2');
            $table->string('kepentingan_3');
            $table->string('kepentingan_4');
            $table->string('kepentingan_5');
            $table->string('kepentingan_6');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kuesioners');
    }
}
