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
            $table->bigInteger('budget_year_id');
            $table->bigInteger('operating_unit');//unit_id
            $table->bigInteger('mfo_id')->nullable();
            $table->bigInteger('pap_id');//pap_id (mfo dependent) (nullable) need to clarify if unit have separate pap from campus pap
            $table->decimal('ps', 15, 2); // personnel services amount
            $table->decimal('mooe', 15, 2); // maintenance and other operating expenses amount
            $table->decimal('co', 15, 2); // capital outlay amount
            $table->decimal('total_amount', 15, 2); // total amount
            $table->bigInteger('processed_by');//user_id budget officer II
            $table->timestamps();
            $table->softDeletes();
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
