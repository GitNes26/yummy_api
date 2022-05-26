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
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('recipe_id');
            $table->string("recipe_name");
            $table->decimal('recipe_quantity', 11, 2)->nullable()->default(0);
            $table->foreignId("measure_id");
            $table->foreignId("row_material_id");
            $table->foreignId("product_id");
            $table->boolean('recipe_active');
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
        Schema::dropIfExists('recipes');
    }
};
