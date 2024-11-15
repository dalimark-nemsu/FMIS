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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('unit_budget_ceiling_id');
            $table->bigInteger('proponent_id');
            $table->bigInteger('created_by');
            $table->string('type');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('purpose')->nullable();
            $table->longText('participants_beneficiaries')->nullable();
            $table->longText('expected_output')->nullable();
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
        Schema::dropIfExists('proposals');
    }
};
