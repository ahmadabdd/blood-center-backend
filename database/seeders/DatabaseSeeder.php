<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Config;

use App\Models\User;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\Hospital;
use App\Models\Blood_request;
use App\Models\Donation;
use App\Models\Health_record;
use App\Models\Connection;
use App\Models\Message;
use App\Models\Notification;

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
            "city_id"=> "7",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg"
        ]);

        User::insert([
            "first_name"=> "Nader",
            "last_name"=> "Zaeter",
            "email"=> "nader@gmail.com",
            "password"=> bcrypt("nader123"),
            "city_id"=> "3",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg"
        ]);

        User::insert([
            "first_name"=> "Abdullah",
            "last_name"=> "Alshami",
            "email"=> "abdullah@gmail.com",
            "password"=> bcrypt("abdullah123"),
            "city_id"=> "2",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg"
        ]);

        User::insert([
            "first_name"=> "Ranim",
            "last_name"=> "Obeidi",
            "email"=> "ranim@gmail.com",
            "password"=> bcrypt("ranim123"),
            "city_id"=> "1",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg"
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
            "blood_type_id" => 3,
            "date_of_birth" => "1999-07-11",
            "last_donation" => "2020-03-20",
            "is_available" => 1,
            "is_smoker" => 0,
            "have_tattoo" => 0,
        ]);

        Health_record::insert([
            "user_id" => 3,
            "blood_type_id" => 6,
            "date_of_birth" => "1999-01-01",
            "last_donation" => "2021-04-05",
            "is_available" => 1,
            "is_smoker" => 0,
            "have_tattoo" => 0,
        ]);

        Health_record::insert([
            "user_id" => 4,
            "blood_type_id" => 8,
            "date_of_birth" => "1999-04-04",
            "last_donation" => "2019-04-21",
            "is_available" => 1,
            "is_smoker" => 0,
            "have_tattoo" => 0,
        ]);


        // Blood Type seeders
        /*
        1- A+
        2- A-
        3- B+
        4- B-
        5- AB+
        6- AB-
        7- O+
        8- O-
        */
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
        /*
        1- Beirut
        2- Tripoli
        3- Saida
        4- Byblos
        5- Zahle
        6- Tyre
        7- Mount Lebanon
        8- Baalbak
        9- Baabda
        */
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
        /*
        1- AUBMC
        2- Cleamenceau
        3- Najjar
        4- Saida Hospital
        5- Tripoli Hospital
        6- Baalbak Hospital
        7- Tyre Hospital
        8- Mount Lebanon Hospital
        9- Baabda Hospital
        */
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


        // Blood_request seeders
        Blood_request::insert([
            "user_id" => 1,
            "blood_type_id" => 2,
            "city_id" => 7,
            "hospital_id" => 8,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-11-20",
            "is_closed" => 0,
        ]);

        Blood_request::insert([
            "user_id" => 2,
            "blood_type_id" => 4,
            "city_id" => 3,
            "hospital_id" => 4,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-24",
            "is_closed" => 0,
        ]);

        Blood_request::insert([
            "user_id" => 3,
            "blood_type_id" => 6,
            "city_id" => 2,
            "hospital_id" => 5,
            "number_of_units" => 2,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-20",
            "is_closed" => 0,
        ]);

        Blood_request::insert([
            "user_id" => 4,
            "blood_type_id" => 8,
            "city_id" => 9,
            "hospital_id" => 9,
            "number_of_units" => 1,
            "left_number_of_units" => 1,
            "expiry_date" => "2021-10-20",
            "is_closed" => 0,
        ]);

        // Donation seeders
        Donation::insert([
            // "user_id" => 1,
            // "blood_request_id" => 2,
            // "is_accepted" => 0
        ]);

        Donation::insert([
            // "user_id" => 2,
            // "blood_request_id" => 2,
            // "is_accepted" => 0
        ]);

        Donation::insert([
            // "user_id" => 3,
            // "blood_request_id" => 3,
            // "is_accepted" => 0
        ]);

        Donation::insert([
            // "user_id" => 4,
            // "blood_request_id" => 4,
            // "is_accepted" => 0
        ]);

        // Connection seeders
        Connection::insert([
            "user_id1" => 1,
            "user_id2" => 2
        ]);
        
        Connection::insert([
            "user_id1" => 2,
            "user_id2" => 1
        ]);

        Connection::insert([
            "user_id1" => 1,
            "user_id2" => 3
        ]);

        Connection::insert([
            "user_id1" => 3,
            "user_id2" => 1
        ]);


        // Message seeders
        Message::insert([
            "connection_id" => 1,
            "sender_id" => 1,
            "receiver_id" => 2,
            "message_body" => "Hi Nader! how are you?"
        ]);

        Message::insert([
            "connection_id" => 1,
            "sender_id" => 2,
            "receiver_id" => 1,
            "message_body" => "Hello Ahmad! I'm good?"
        ]);

        Message::insert([
            "connection_id" => 1,
            "sender_id" => 1,
            "receiver_id" => 2,
            "message_body" => "Are you coming to donate today?"
        ]);

        Message::insert([
            "connection_id" => 1,
            "sender_id" => 2,
            "receiver_id" => 1,
            "message_body" => "Yes sure! I'll be there by 12pm"
        ]);

        Message::insert([
            "connection_id" => 1,
            "sender_id" => 1,
            "receiver_id" => 2,
            "message_body" => "Great! Seeya"
        ]);

        // Notification seeders
        // Notification::insert([
        //     'sender' => 1,
        //     'receiver' => 2,
        //     'blood_request_id' => 2,
        //     'header' => 'New A+ request!',
        //     'body' => 'Would you like to donate?'
        // ]); 

        // Notification::insert([
        //     'sender' => 2,
        //     'receiver' => 1,
        //     'blood_request_id' => 3,
        //     'header' => 'New AB+ request!',
        //     'body' => 'Would you like to donate?'
        // ]);

        // Notification::insert([
        //     'sender' => 1,
        //     'receiver' => 2,
        //     'blood_request_id' => 2,
        //     'header' => 'New donor!',
        //     'body' => 'Ahmad Abd has accepted your blood request.'
        // ]);
    }
}
