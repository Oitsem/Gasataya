<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalAssistanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_assistance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->bigInteger('person_id')->unsigned()->nullable();
            $table->foreign('person_id')
                ->references('id')
                ->on('persons');
            $table->string('file')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->boolean('hospital_bills')->default(false);
            $table->boolean('medicines')->default(false);
            $table->boolean('consultation')->default(false);
            $table->boolean('medical_supplies')->default(false);
            $table->boolean('minor_procedures')->default(false);
            $table->boolean('laboratory')->default(false);
            $table->boolean('laboratory_test')->default(false);
            $table->boolean('blood_processing')->default(false);
            $table->boolean('biopsy')->default(false);
            $table->boolean('laboratory_others')->default(false);
            $table->boolean('radiology')->default(false);
            $table->boolean('xray')->default(false);
            $table->boolean('ct_scan')->default(false);
            $table->boolean('utz')->default(false);
            $table->boolean('echo')->default(false);
            $table->boolean('mri')->default(false);
            $table->boolean('radiology_others')->default(false);
            $table->string('radiology_others_detail')->nullable();
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
        Schema::dropIfExists('medical_assistance');
    }
}
