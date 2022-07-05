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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements("prov_id");
            $table->string("prov_name");
            $table->string("prov_country");
            $table->string("prov_state");
            $table->string("prov_city");
            $table->string("prov_suburb");
            $table->string("prov_address");
            $table->string("prov_phone_contact");
            $table->string("prov_contact_name");
            $table->boolean("prov_active");
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
        Schema::dropIfExists('providers');
    }
};
