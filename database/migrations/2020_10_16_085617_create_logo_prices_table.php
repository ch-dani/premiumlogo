<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogoPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logo_prices', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('price');
            $table->string('currency')->nullable();
            $table->string('symbol')->nullable();
            $table->text('advantages');
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
        Schema::dropIfExists('logo_prices');
    }
}
