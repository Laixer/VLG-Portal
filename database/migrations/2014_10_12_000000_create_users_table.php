<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_functions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
        });

        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group', 30);
            $table->string('name', 80);
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('domain', 120);
            $table->string('icon', 32);
            $table->string('color', 20);
            $table->boolean('active')->default(1);
            $table->string('public_token', 40)->unique();
            $table->string('private_token', 40)->unique();
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80);
            $table->string('visit_address', 120)->nullable();
            $table->string('visit_address_number', 4)->nullable();
            $table->string('visit_postal', 6)->nullable();
            $table->string('post_address', 120);
            $table->string('post_address_number', 4);
            $table->string('post_postal', 6);
            $table->string('website');
            $table->string('email', 120);
            $table->string('postbox', 8)->nullable();
            $table->string('phone', 15)->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('last_name');
            $table->string('phone', 15)->nullable();
            $table->string('mobile', 15);
            $table->string('note')->nullable();
            $table->boolean('active')->default(1);
            $table->integer('functions_id')->unsigned();
            $table->foreign('functions_id')->references('id')->on('user_functions');
            $table->integer('user_type_id')->unsigned();
            $table->foreign('user_type_id')->references('id')->on('user_types');
            $table->integer('companies_id')->unsigned()->nullable();
            $table->foreign('companies_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('application_user', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('read')->default(0);
            $table->boolean('write')->default(0);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('application_id')->unsigned()->nullable();
            $table->foreign('application_id')->references('id')->on('applications')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('audits');
        Schema::dropIfExists('application_user');
        Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('user_types');
        Schema::dropIfExists('user_functions');
    }
}
