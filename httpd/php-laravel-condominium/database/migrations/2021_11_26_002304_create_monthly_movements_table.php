<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("monthly_movements", function (Blueprint $table) {
            $table->id();
            $table->year("year");
            $table->unsignedSmallInteger("month");
            $table->decimal("fund", 12, 2)->default("0");
            $table->boolean("is_generated")->default(false);
            $table->unique(["year", "month"]);
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
        Schema::dropIfExists("monthly_movements");
    }
}
