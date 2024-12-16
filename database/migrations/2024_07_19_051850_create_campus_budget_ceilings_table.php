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
            $table->bigInteger('campus_id');
            $table->bigInteger('budget_year_id');
            $table->bigInteger('pap_id');
            $table->decimal('ps', 15, 2)->default(0); // personnel services amount
            $table->decimal('mooe', 15, 2)->default(0); // maintenance and other operating expenses amount
            $table->decimal('co', 15, 2)->default(0); // capital outlay amount
            $table->decimal('total_amount', 15, 2)->default(0); // total amount
            $table->boolean('is_posted')->default(0);
            $table->bigInteger('processed_by');//user_id budget officer III
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
        Schema::dropIfExists('campus_budget_ceilings');
    }
};
