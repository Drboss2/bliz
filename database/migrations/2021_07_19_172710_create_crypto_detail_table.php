<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cryptoassets_id')->constrained()->onDelete('cascade');
            $table->string('crypto_name');
            $table->string('min');
            $table->string('max');
            $table->string('rate');
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
        Schema::dropIfExists('crypto_detail');
    }
}
