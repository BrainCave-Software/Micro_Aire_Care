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
        Schema::create('project_files', function (Blueprint $table) {
            $table->id();
            $table->string('owner_id');
            $table->string('project_file');
            $table->string('job_sheet');
            $table->string('client_name');
            $table->string('mobile');
            $table->string('sale_person')->nullable();
            $table->string('address');
            $table->string('sale_contact')->nullable();
            $table->json('task')->nullable();
            $table->string('postalCode')->nullable();
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
        Schema::dropIfExists('project_files');
    }
};
