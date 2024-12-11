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
            // $table->bigInteger('unit_budget_ceiling_id');
            $table->bigInteger('operating_unit'); //unit_id
            $table->bigInteger('budget_year_id');
            $table->enum('proposal_type', ['project', 'activity']);
            $table->string('proposal_title');
            $table->bigInteger('proposal_proponent_id');
            $table->longText('proposal_description')->nullable();
            $table->longText('proposal_purpose')->nullable();
            $table->longText('proposal_participants_beneficiaries')->nullable();
            $table->longText('proposal_expected_output')->nullable();
            $table->bigInteger('created_by');
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
