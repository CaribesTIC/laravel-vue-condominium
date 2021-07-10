<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->date('date')->useCurrent();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('task_id')->references('id')->on('tasks');           
            $table->foreignId('zone_id')->references('id')->on('zones');
            $table->time('input');
            $table->time('output');
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
        Schema::dropIfExists('journals');
    }
}
