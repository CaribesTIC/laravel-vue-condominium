<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDwellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwellings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 10)->unique();
            $table->integer('location');
            $table->float('aliquot');
            $table->boolean('is_habited')->default(true);
            $table->foreignId('dwelling_type_id')->references('id')->on('dwelling_types');            
            $table->foreignId('user_id')->references('id')->on('users');            
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
        Schema::dropIfExists('dwellings');
    }
}
