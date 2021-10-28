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
            $table->string('firebase_token')->nullable();
            $table->text('profile_picture_url')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });

        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
            $table->integer('blood_type_id')->nullable();	
            $table->date('date_of_birth')->nullable();	
            $table->date('last_donation')->nullable();	
            $table->boolean('is_available')->nullable();
            $table->boolean('is_smoker')->nullable();
            $table->boolean('have_tattoo')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
			$table->softDeletes();
        });

        Schema::create('blood_types', function (Blueprint $table) {
            $table->id();
			$table->string('type');
        });

        Schema::create('blood_requests', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->nullable();
            $table->integer('blood_type_id')->nullable();	
            $table->integer('city_id')->nullable();	
            $table->integer('hospital_id')->nullable();	
            $table->integer('number_of_units')->nullable();	
            $table->integer('left_number_of_units')->nullable();	
            $table->date('expiry_date')->nullable();	
            $table->boolean('is_closed')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
			$table->softDeletes();
        });

        Schema::create('donations', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id');
            $table->integer('blood_request_id');	
            $table->integer('is_accepted');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
			$table->softDeletes();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
			$table->string('name');
            $table->string('long');
            $table->string('lat');
        });

        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
			$table->string('name');
            $table->string('city_id');
            $table->string('long');
            $table->string('lat');
        });
        
        Schema::create('connections', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id1');
            $table->integer('user_id2');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
        
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('connection_id');
            $table->integer('sender_id');
            $table->integer('receiver_id');
			$table->text('message_body');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('sender');
            $table->integer('receiver');
            $table->integer('blood_request_id')->nullable();
			$table->string('header');
			$table->string('body');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
