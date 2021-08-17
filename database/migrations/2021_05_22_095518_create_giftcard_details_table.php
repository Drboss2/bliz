<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftcardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giftcard_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('giftcards_id')->constrained()->onDelete('cascade');
            $table->string('card_type');
            $table->string('card_country');
            $table->integer('price');
            $table->string('buying_min');
            $table->string('buying_max');
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
        Schema::dropIfExists('giftcard_details');
    }
}
