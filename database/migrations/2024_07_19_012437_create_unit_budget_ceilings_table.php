<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_budget_ceilings', function (Blueprint $table) {
            $table->id();
            $table->integer('fund_source_id')->nullable();
            $table->integer('campus_id');
            $table->bigInteger('operating_unit');
            $table->bigInteger('mfo_id')->nullable();
            $table->bigInteger('pap_id');
            $table->decimal('budget_celing', 15, 2); // personnel service ammount
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
        Schema::dropIfExists('unit_budget_ceilings');
    }
};
