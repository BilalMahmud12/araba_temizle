<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_phones', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_default')->default(0);
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->boolean('domestic')->default(1);
            $table->string('dial_code')->default('90');
            $table->string('phone_number');
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
        Schema::dropIfExists('client_phones');
    }
}
