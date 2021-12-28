<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableHireDesignerMessagesAddNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hire_designer_messages', function (Blueprint $table) {
            $table->text('answer_message')->after('message')->nullable();
            $table->boolean('answered')->after('answer_message')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hire_designer_messages', function (Blueprint $table) {
            $table->dropColumn('answer_message');
            $table->dropColumn('answered');
        });
    }
}
