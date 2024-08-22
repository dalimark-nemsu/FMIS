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
        Schema::create('campus_budget_ceilings', function (Blueprint $table) {
            $table->id();
            $table->integer('campus_id');
            $table->integer('budget_year_id');
            $table->bigInteger('pap_id');
            $table->decimal('ps', 15, 2); // personnel service ammount
            $table->decimal('mooe', 15, 2); // maintenance and other operating expenses ammount
            $table->decimal('co', 15, 2); // capital outlay ammount
            $table->integer('processed_by');
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
        Schema::dropIfExists('campus_budget_ceilings');
    }
};
