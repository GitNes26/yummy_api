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
            $table->bigIncrements('rec_id');
            $table->string("rec_milk");
            $table->decimal('rec_quantity_usage', 11, 2)->nullable()->default(0);//tamaño CH, MD, GD
            $table->enum("rec_measure",["kilogramo", "gramos", "litros", "mililitros", "miligramos"]); //postres, ensaladas, Cafes
            $table->foreignId("rec_pro_id")->constrained("products", "pro_id");
            $table->boolean('rec_active')->default(true);
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
