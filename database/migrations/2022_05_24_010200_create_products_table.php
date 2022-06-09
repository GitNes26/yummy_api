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
            $table->bigIncrements('pro_id');
<<<<<<< HEAD
            $table->string('product_name');
            $table->foreignId('category_id');
            $table->decimal('product_price', 11,2);
            $table->boolean('product_active');
=======
            $table->string('pro_name');
            $table->foreignId('pro_cat_id')->constrained('categories', 'cat_id');
            $table->decimal('pro_price', 11,2);
            $table->boolean('pro_active');
>>>>>>> cd2511b11fec89214498ff512947fd4cc79accd2
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
