<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBurialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('burial', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')
                ->references('id')
                ->on('persons');
            $table->string('relation_to_the_deceased_person');
            $table->string('name_of_deceased_person');
            $table->string('place_of_wake');
            $table->string('place_of_burial');
            $table->dateTime('date_and_time_of_burial');
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
        Schema::dropIfExists('burial');
    }
}
