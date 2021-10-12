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
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('city_id');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
            $table->integer('blood_type_id');	
            $table->date('date_of_birth');	
            $table->date('last_donation');	
            $table->boolean('is_available');
            $table->boolean('is_smoker');
            $table->boolean('have_tattoo');
            $table->timestamps();
			$table->softDeletes();
        });

        Schema::create('blood_types', function (Blueprint $table) {
            $table->id();
			$table->string('type');
            $table->timestamps();
			$table->softDeletes();
        });

        Schema::create('requests', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
            $table->integer('blood_type_id');	
            $table->integer('hospital_id');	
            $table->integer('number_of_units');	
            $table->integer('left_number_of_units');	
            $table->date('expiry_date');	
            $table->boolean('is_closed');
            $table->timestamps();
			$table->softDeletes();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
            $table->integer('request_id');	
            $table->boolean('is_accepted');
            $table->timestamps();
			$table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
			$table->string('name');
        });

        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
			$table->string('name');
            $table->integer('city_id');
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
