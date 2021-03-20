<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClubMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_club_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('club_id');
            $table->string('club_name');
            $table->string('title')->nullable();
            $table->string('status')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();

//            "id" => 368
//          "name" => "HK Munkacsoportok"
//          "status" => "tag"
//          'title
//          "start" => "2018-06-06"
//          "end" => null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_club_memberships');
    }
}
