<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //$table->id();
            $table->string('id')->unique();
            $table->string('displayName')->nullable()->default(null);
            $table->string('sn')->nullable()->default(null);
            $table->string('givenName')->nullable()->default(null);
            $table->string('mail')->nullable()->default(null);
            $table->string('linkedAccounts')->nullable()->default(null);
            $table->longtext('eduPersonEntitlement')->nullable()->default(null);
            $table->string('mobile')->nullable()->default(null);
            $table->longtext('niifEduPersonAttendedCourse')->nullable()->default(null);   // kesz kulon tablaban
            $table->longtext('entrants')->nullable()->default(null);
            $table->longtext('admembership')->nullable()->default(null);
            $table->string('bmeunitscope')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
