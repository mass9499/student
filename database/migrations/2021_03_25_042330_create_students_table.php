<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('password');
            $table->string('dob');
            $table->string('student_code')->from('ASES0001');
            $table->string('application_date');
            $table->string('university_name');
            $table->string('application_id');
            $table->string('major');
            $table->string('intake');
            $table->string('status');
            $table->string('action_needed');
            $table->string('comments');
            $table->string('login_id');
            $table->string('login_password');
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
        Schema::dropIfExists('students');
    }
}
