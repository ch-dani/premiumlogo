<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignerPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designer_plans', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('price');
            $table->string('currency')->nullable();
            $table->string('symbol')->nullable();
            $table->text('advantages');
            $table->boolean('is_black')->default(0);
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
        Schema::dropIfExists('designer_plans');
    }
}
