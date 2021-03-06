<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChedScholarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ched_scholars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')
                ->references('id')
                ->on('persons');
            $table->string('file')->nullable();

            $table->string('school_last_attended')->nullable();
            $table->text('school_last_attended_address')->nullable();
            $table->tinyInteger('highest_attained_grade')->unsigned();
            $table->boolean('school_last_attended_sector')->nullable();

            $table->tinyInteger('school_intended_to_enroll');
            $table->text('school_intended_to_enroll_address');
            $table->string('degree_program');
            $table->boolean('school_intended_to_enroll_sector');
            
            $table->string('fathers_first_name')->nullable();
            $table->string('fathers_middle_name')->nullable();
            $table->string('fathers_last_name')->nullable();
            $table->string('fathers_extension_name')->nullable();
            $table->string('fathers_address')->nullable();
            $table->string('fathers_city')->nullable();
            $table->string('fathers_province')->nullable();
            $table->string('fathers_contact_number')->nullable();
            $table->string('fathers_occupation')->nullable();
            $table->integer('fathers_annual_gross_income')->unsigned()->nullable();
            $table->string('fathers_name_of_employer')->nullable();
            $table->string('fathers_employer_address')->nullable();

            $table->string('mothers_first_name')->nullable();
            $table->string('mothers_middle_name')->nullable();
            $table->string('mothers_last_name')->nullable();
            $table->string('mothers_address')->nullable();
            $table->string('mothers_city')->nullable();
            $table->string('mothers_province')->nullable();
            $table->string('mothers_contact_number')->nullable();
            $table->string('mothers_occupation')->nullable();
            $table->integer('mothers_annual_gross_income')->unsigned()->nullable();
            $table->string('mothers_name_of_employer')->nullable();
            $table->string('mothers_employer_address')->nullable();

            $table->string('legal_guardian_first_name')->nullable();
            $table->string('legal_guardian_middle_name')->nullable();
            $table->string('legal_guardian_last_name')->nullable();
            $table->string('legal_guardian_extension_name')->nullable();
            $table->string('legal_guardian_address')->nullable();
            $table->string('legal_guardian_city')->nullable();
            $table->string('legal_guardian_province')->nullable();
            $table->string('legal_guardian_contact_number')->nullable();
            $table->string('legal_guardian_occupation')->nullable();
            $table->integer('legal_guardian_annual_gross_income')->unsigned()->nullable();
            $table->string('legal_guardian_name_of_employer')->nullable();
            $table->string('legal_guardian_employer_address')->nullable();

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
        Schema::dropIfExists('ched_scholars');
    }
}
