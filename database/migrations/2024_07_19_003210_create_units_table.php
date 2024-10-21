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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable(); // Self-referencing foreign key
            $table->integer('sequence')->nullable(); // For ordering units
            $table->string('abbreviation')->nullable();
            $table->string('name');
            $table->bigInteger('unit_head')->nullable(); // Foreign key referencing user_id
            $table->bigInteger('campus_id'); // Foreign key referencing campus_id
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
        Schema::dropIfExists('units');
    }
};
