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
        Schema::create('rolepreviledges', function (Blueprint $table) {
            $table->id();
            $table->string('owner_id')->nullable();
            $table->string('role_id')->nullable();
            $table->string('role_name')->nullable();
            $table->string('access')->nullable();
            $table->string('role_modules')->nullable();
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
        Schema::dropIfExists('rolepreviledges');
    }
};
