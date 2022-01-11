<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('rut')->nullable();
            $table->string('phone')->nullable();
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('campaign')->nullable();
            $table->string('number')->nullable();
            $table->string('details')->nullable();
            $table->string('commune_string')->nullable();
            $table->tinyInteger('status_service')->default(0);

            $table->unsignedBigInteger('commune_id')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('manual_entry')->default(0);

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
        Schema::dropIfExists('forms');
    }
}
