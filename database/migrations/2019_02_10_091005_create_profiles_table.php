<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('name', 40)->nullable();
            $table->string('user_email', 100)->nullable();
            $table->string('address', 60)->nullable();
            $table->unsignedInteger('country_id')->default(101);
            $table->unsignedInteger('region_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('phone', 20)->nullable();
            $table->char('gender')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('updated_by', 100)->default('');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_email')->references('email')->on('users');
            // $table->foreign('country_id')->references('id')->on('countries');
            // $table->foreign('region_id')->references('id')->on('regions');
            // $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
