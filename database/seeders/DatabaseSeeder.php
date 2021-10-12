<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\Hospital;
use App\Models\Request;
use App\Models\Donation;
use App\Models\Health_record;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users seeders
        User::insert([
            "first_name"=> "Ahmad",
            "last_name"=> "Abd",
            "email"=> "ahmad@gmail.com",
            "password"=> bcrypt("ahmad123"),
            "city_id"=> "7"
        ]);

        User::insert([
            "first_name"=> "Nader",
            "last_name"=> "Zaeter",
            "email"=> "nader@gmail.com",
            "password"=> bcrypt("nader123"),
            "city_id"=> "3"
        ]);

        User::insert([
            "first_name"=> "Abdullah",
            "last_name"=> "Alshami",
            "email"=> "abdullah@gmail.com",
            "password"=> bcrypt("abdullah123"),
            "city_id"=> "2"
        ]);

        User::insert([
            "first_name"=> "Ranim",
            "last_name"=> "Obeidi",
            "email"=> "ranim@gmail.com",
            "password"=> bcrypt("ranim123"),
            "city_id"=> "1"
        ]);


        // Health_record seeders
        Health_record::insert([
            "user_id" => 1,
            "blood_type_id" => 5,
            "date_of_birth" => "1998-07-11",
            "last_donation" => "2021-08-18",
            "is_available" => 1,
            "is_smoker" => 0,
            "have_tattoo" => 0,
        ]);

        Health_record::insert([
            "user_id" => 2,
            "blood_type_id" => 1,
            "date_of_birth" => "1999-07-11",
            "last_donation" => "2020-03-20",
            "is_available" => 1,
            "is_smoker" => 0,
            "have_tattoo" => 0,
        ]);

        Health_record::insert([
            "user_id" => 3,
            "blood_type_id" => 2,
            "date_of_birth" => "1999-01-01",
            "last_donation" => "2021-04-05",
            "is_available" => 0,
            "is_smoker" => 1,
            "have_tattoo" => 0,
        ]);

        Health_record::insert([
            "user_id" => 4,
            "blood_type_id" => 3,
            "date_of_birth" => "1999-04-04",
            "last_donation" => "2019-04-21",
            "is_available" => 1,
            "is_smoker" => 0,
            "have_tattoo" => 0,
        ]);


        // Blood Type seeders
        Blood_type::insert([
            "type" => "A+"
        ]);

        Blood_type::insert([
            "type" => "A-"
        ]);

        Blood_type::insert([
            "type" => "B+"
        ]);

        Blood_type::insert([
            "type" => "B-"
        ]);

        Blood_type::insert([
            "type" => "AB+"
        ]);

        Blood_type::insert([
            "type" => "AB-"
        ]);

        Blood_type::insert([
            "type" => "O+"
        ]);

        Blood_type::insert([
            "type" => "O-"
        ]);


        // City seeders
        City::insert([
            "name" => "Beirut"
        ]);

        City::insert([
            "name" => "Tripoli"
        ]);

        City::insert([
            "name" => "Saida"
        ]);

        City::insert([
            "name" => "Byblos"
        ]);

        City::insert([
            "name" => "Zahle"
        ]);

        City::insert([
            "name" => "Tyre"
        ]);

        City::insert([
            "name" => "Mount Lebanon"
        ]);

        City::insert([
            "name" => "Baalbak"
        ]);

        City::insert([
            "name" => "Baabda"
        ]);


        // Hospital seeders
        Hospital::insert([
            "name" => "AUBMC",
            "city_id" => "1"
        ]);
        Hospital::insert([
            "name" => "Cleamenceau",
            "city_id" => "1"
        ]);
        Hospital::insert([
            "name" => "Najjar",
            "city_id" => "1"
        ]);
        Hospital::insert([
            "name" => "Saida Hospital",
            "city_id" => "3"
        ]);
        Hospital::insert([
            "name" => "Tripoli Hospital",
            "city_id" => "2"
        ]);
        Hospital::insert([
            "name" => "Baalbak Hospital",
            "city_id" => "8"
        ]);
        Hospital::insert([
            "name" => "Tyre Hospital",
            "city_id" => "6"
        ]);
        Hospital::insert([
            "name" => "Mount Lebanon Hospital",
            "city_id" => "7"
        ]);
        Hospital::insert([
            "name" => "Baabda Hospital",
            "city_id" => "9"
        ]);


        // Request seeders
        Request::insert([
            "user_id" => 1,
            "blood_type_id" => 5,
            "city_id" => 7,
            "hospital_id" => 1,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-20",
            "is_closed" => 0,
        ]);

        Request::insert([
            "user_id" => 2,
            "blood_type_id" => 1,
            "city_id" => 1,
            "hospital_id" => 2,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-20",
            "is_closed" => 0,
        ]);

        Request::insert([
            "user_id" => 3,
            "blood_type_id" => 2,
            "city_id" => 2,
            "hospital_id" => 4,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-20",
            "is_closed" => 0,
        ]);

        Request::insert([
            "user_id" => 4,
            "blood_type_id" => 6,
            "city_id" => 1,
            "hospital_id" => 3,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-20",
            "is_closed" => 0,
        ]);

        // Donation seeders
        Donation::insert([
            "user_id" => 1,
            "request_id" => 2,
            "is_accepted" => 0
        ]);

        Donation::insert([
            "user_id" => 2,
            "request_id" => 2,
            "is_accepted" => 0
        ]);

        Donation::insert([
            "user_id" => 3,
            "request_id" => 3,
            "is_accepted" => 0
        ]);

        Donation::insert([
            "user_id" => 4,
            "request_id" => 4,
            "is_accepted" => 0
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
