<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_files', function (Blueprint $table) {
            $table->id();
            $table->text('user_id');
            $table->integer("is_temp_user");
            $table->text('path');
            $table->text('relative_path');

            $table->enum('xtype', ['svg', 'archive']);
            
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
      //  Schema::dropIfExists('user_files');
    }
}

//php artisan migrate --path=//var/www/logo-maker/database/migrations/2020_10_22_112406_create_user_files.php
