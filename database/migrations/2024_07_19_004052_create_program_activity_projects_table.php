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
        Schema::create('program_activity_projects', function (Blueprint $table) {
            $table->id();
            

            //$table->string('code')->nullable();
            //$table->bigInteger('mfo_id')->nullable(); //major final output //remove in version2

            

            $table->bigInteger('fund_source_id');
            $table->bigInteger('budget_type_id')->nullable();
            $table->bigInteger('sub_fund_id')->nullable();
            $table->bigInteger('school_fee_classification_id')->nullable();
            $table->bigInteger('pap_type_id');
            $table->bigInteger('parent_id')->nullable();
            $table->integer('sequence')->nullable();
            $table->string('name');
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
        Schema::dropIfExists('program_activity_projects');
    }
};
