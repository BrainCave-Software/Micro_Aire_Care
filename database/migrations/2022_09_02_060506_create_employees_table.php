<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('owner_id');
            $table->string('users_id');
            $table->string('name');
            $table->string('main_department');
            $table->string('designation');
            $table->string('user_name');
            $table->string('email_id');
            $table->string('gender');
            $table->string('contact_no');
            $table->string('password');
            $table->string('view_password');
            $table->string('role');
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
        Schema::dropIfExists('employees');
    }
};
