<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyMovementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_movement_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monthly_movement_id')->references('id')->on('monthly_movements');           
            $table->text('description')->default('');
            $table->decimal('amount', 12, 2)->default('0');
            $table->boolean('is_expense')->default(true);
            $table->boolean('is_ordinal')->default(true);
            $table->boolean('is_general')->default(true);
            $table->foreignId('dwelling_id')->nullable()->references('id')->on('dwellings');
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
        Schema::dropIfExists('monthly_movement_details');
    }
}
