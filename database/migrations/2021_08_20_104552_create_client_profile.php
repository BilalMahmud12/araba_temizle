<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->string('national_id')->nullable();
            $table->string('photo')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('locale')->default('tr');
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
        Schema::dropIfExists('client_profile');
    }
}
