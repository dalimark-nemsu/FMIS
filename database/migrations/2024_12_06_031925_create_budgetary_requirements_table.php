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
        Schema::create('budgetary_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('itemable_type');
            $table->bigInteger('itemable_id');
            $table->longText('general_description');
            $table->string('uom');
            $table->integer('quantity');
            $table->decimal('unit_cost', 10, 2);
            $table->bigInteger('procurement_mode_id')->nullable();
            $table->bigInteger('object_expenditure_id')->nullable();
            $table->bigInteger('unit_budget_ceiling_id')->nullable();
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
        Schema::dropIfExists('budgetary_requirements');
    }
};
