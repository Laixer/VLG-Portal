<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->string('domain', 30)->default('localhost');
            $table->string('interface', 30)->default('web');
            $table->integer('last_activity');
        });

        Schema::table('sessions', function ($table) {
            $table->string('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('sessions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function ($table) {
            $table->dropForeign('sessions_parent_id_foreign');
        });

        Schema::drop('sessions');
    }
}
