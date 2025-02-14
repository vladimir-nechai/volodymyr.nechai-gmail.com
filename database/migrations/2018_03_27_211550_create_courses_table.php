<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment = "Course name in univis";
            $table->string('short_name')->nullable()->comment = "Short course name in univis";
            $table->unsignedInteger('chair_id');
            $table->string('course_type')->comment = "Lecture, seminar or tutorial";
            $table->string('univis_id')->nullable()->unique();
            $table->string('univis_hash')->nullable()->unique();
            $table->string('univis_key')->nullable()->unique();
            $table->string('ects')->nullable();
            $table->integer('sws')->nullable()->comment = "Semester Wochen Stunden";
            $table->integer('max_turnout')->nullable()->comment = "Maximum amount of students";
            $table->string('language')->nullable()->comment = "D, DE: german; E, EN:english";
            $table->text('summary')->nullable()->comment = "Course description";
            $table->timestamps();

            $table->foreign('chair_id')->references('id')->on('chairs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
