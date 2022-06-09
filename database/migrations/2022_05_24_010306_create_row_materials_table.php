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
        Schema::create('row_materials', function (Blueprint $table) {
            $table->bigIncrements("rm_id");
            $table->string("rm_name");
            //$table->foreignId("rm_prov_id")->constrained(); PROVEEDORES
            $table->enum("rm_measure_unity", ["kilogramo", "gramos", "litros", "mililitros", "miligramos", "toneladas", "galones"]);
            $table->decimal("rm_unity_quantity",11,2)->default(0.00);
            $table->integer("rm_stock")->default(1);
            $table->decimal("rm_unit_price",11,2)->default(0.00);
            $table->boolean("rm_active");
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
        Schema::dropIfExists('row_materials');
    }
};
