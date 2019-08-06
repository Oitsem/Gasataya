<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('extension_name')->nullable();
            $table->text('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->tinyInteger('civil_status')->nullable();
            $table->string('citizenship')->default('Filipino');
            $table->tinyInteger('number_of_siblings')->unsigned()->nullable();
            $table->boolean('sex')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('mobile_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('zip_code')->default('6100');
            $table->string('district')->default('Lone');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
