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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('owner_id');
            $table->string('project_id');
            $table->string('project_title');
            $table->string('clientExcel_name');
            $table->string('address');
            $table->string('start_date');
            $table->string('deadline');
            $table->string('mobile');
            $table->string('assign_to');
            $table->string('sale_contact');
            $table->json('task1')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
