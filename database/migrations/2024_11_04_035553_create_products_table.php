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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable();
            $table->string('photo')->nullable();
            $table->string('product_description');
            $table->string('product_specification')->nullable();
            $table->string('attachment')->nullable();
            $table->string('uom'); //unit of measure
            $table->decimal('price', 10,2);
            $table->string('remarks')->nullable();
            $table->boolean('is_available')->default(0);
            $table->enum('source', ['dbm', 'local']);
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
        Schema::dropIfExists('products');
    }
};
