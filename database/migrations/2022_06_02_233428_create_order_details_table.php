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
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('od_id');
            $table->foreignId('od_order_id')->constrained('orders','order_id');
            $table->foreignId('od_recipe_id')->constrained('recipes','rec_id');
            $table->decimal('od_unit_price',11,2);
            $table->integer('od_quantity');
            $table->string('od_complement');
            $table->string('od_names');
            $table->decimal('od_discount', 11,2)->default(0);
            $table->boolean('od_active')->default(true);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
