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
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg",
            "firebase_token" => "ExponentPushToken[1frKTGIDmWxMrxv3KFhWKm]"
        ]);

        User::insert([
            "first_name"=> "Nader",
            "last_name"=> "Zaeter",
            "email"=> "nader@gmail.com",
            "password"=> bcrypt("nader123"),
            "city_id"=> "3",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg",
            "firebase_token" => "ExponentPushToken[1frKTGIDmWxMrxv3KFhWKm]"
        ]);

        User::insert([
            "first_name"=> "Abdullah",
            "last_name"=> "Alshami",
            "email"=> "abdullah@gmail.com",
            "password"=> bcrypt("abdullah123"),
            "city_id"=> "2",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg",
            "firebase_token" => "ExponentPushToken[1frKTGIDmWxMrxv3KFhWKm]"
        ]);

        User::insert([
            "first_name"=> "Ranim",
            "last_name"=> "Obeidi",
            "email"=> "ranim@gmail.com",
            "password"=> bcrypt("ranim123"),
            "city_id"=> "1",
            "profile_picture_url" => "https://blood-center.tk/storage/facebook-default-photo-male_1-1.jpg",
            "firebase_token" => "ExponentPushToken[1frKTGIDmWxMrxv3KFhWKm]"
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
        1- Beirut 33.895094962662675, 35.50316943278384
        2- Tripoli 34.433784047086554, 35.83747600954299
        3- Saida 33.547056441601306, 35.37094717630806
        4- Byblos 34.12677632074071, 35.65062899202389
        5- Zahle 33.85150982172688, 35.89527702193855
        6- Tyre 33.2526827791365, 35.207236433311735
        7- Mount Lebanon 33.86162526581892, 35.52186809196221
        8- Baalbak 34.01976543467678, 36.2177470222216
        9- Baabda 33.83919858833566, 35.54171205234172
        10- Nabatieh 33.37758655008111, 35.484317387428504
        */
        City::insert([//1
            "name" => "Beirut",
            "long" => "33.895094962662675",
            "lat" => "35.50316943278384"
        ]);

        City::insert([//2
            "name" => "Tripoli",
            "long" => "34.433784047086554",
            "lat" => "35.83747600954299"
        ]);

        City::insert([//3
            "name" => "Saida",
            "long" => "33.547056441601306",
            "lat" => "35.37094717630806"
        ]);

        City::insert([//4
            "name" => "Byblos",
            "long" => "34.12677632074071",
            "lat" => "35.65062899202389"
        ]);

        City::insert([//5
            "name" => "Zahle",
            "long" => "33.85150982172688",
            "lat" => "35.89527702193855"
        ]);

        City::insert([//6
            "name" => "Tyre",
            "long" => "33.2526827791365", 
            "lat" => "35.207236433311735"
        ]);

        City::insert([//7
            "name" => "Mount Lebanon",
            "long" => "33.86162526581892",
            "lat" => "35.52186809196221"
        ]);

        City::insert([//8
            "name" => "Baalbak",
            "long" => "34.01976543467678", 
            "lat" => "36.2177470222216"
        ]);

        City::insert([//9
            "name" => "Baabda",
            "long" => "33.83919858833566", 
            "lat" => "35.54171205234172" 
        ]);

        City::insert([//10
            "name" => "Nabatieh",
            "long" => "33.37758655008111", 
            "lat" => "35.484317387428504" 
        ]);


        // Hospital seeders
        /*
        1- AUBMC 33.89794103720954, 35.48581257502805 *
        2- Cleamenceau 33.898185257086276, 35.49007782548146 *
        3- Najjar Hospital 33.89702378836769, 35.48674598368463 *
        4- Trad Hospital 33.897041599125465, 35.4918099941707 *
        5- Saida Hospital 33.546336544647005, 35.381781901628386 *
        6- Tripoli Hospital 34.43818448033412, 35.85999664800973 *
        7- Haykal Hospital 34.4132645736662, 35.83177320060943 *
        8- Al Salam Hospital 34.42222651674446, 35.827160649733486 *
        9- Baalbak Hospital 33.99935939739805, 36.213727355195736 *
        10- Hiram Hospital 33.282584370569836, 35.22264276122027 *
        11- Mount Lebanon Hospital 33.86010250707405, 35.523922827788425 *
        12- Baabda Hospital 33.8363211714327, 35.5388334758363 *
        13- Rafic Hariri Hospital 33.86437883052882, 35.49147882912746 *
        14- Rizk Hospital 33.88612661009286, 35.51484561276833 *
        15- St. Georges Hospital 33.83754952099413, 35.526945957473586 *
        16- Bchamoun Hospital 33.783633212262714, 35.52332864213094
        */
        Hospital::insert([//1
            "name" => "AUBMC",
            "city_id" => "1",
            "long" => "33.89794103720954",
            "lat" => "35.48581257502805"
        ]);
        Hospital::insert([//2
            "name" => "Cleamenceau",
            "city_id" => "1",
            "long" => "33.898185257086276",
            "lat" => "35.49007782548146"
        ]);
        Hospital::insert([//3
            "name" => "Najjar Hospital",
            "city_id" => "1",
            "long" => "33.89702378836769",
            "lat" => "35.48674598368463"
        ]);
        Hospital::insert([//4
            "name" => "Trad Hospital",
            "city_id" => "1",
            "long" => "33.897041599125465",
            "lat" => "35.4918099941707"
        ]);
        Hospital::insert([//5
            "name" => "St. Georges Hospital",
            "city_id" => "1",
            "long" => "33.83754952099413",
            "lat" => "35.526945957473586"
        ]);
        Hospital::insert([//6
            "name" => "Rizk Hospital", 
            "city_id" => "1",
            "long" => "33.88612661009286",
            "lat" => "35.51484561276833"
        ]);
        Hospital::insert([//7
            "name" => "Rafic Hariri Hospital",
            "city_id" => "1",
            "long" => "33.86437883052882",
            "lat" => "35.49147882912746"
        ]);
        Hospital::insert([//8
            "name" => "Saida Hospital",
            "city_id" => "3", 
            "long" => "33.546336544647005",
            "lat" => "35.381781901628386"
        ]);
        Hospital::insert([//9
            "name" => "Tripoli Hospital",
            "city_id" => "2",
            "long" => "34.43818448033412",
            "lat" => "35.85999664800973"
        ]);
        Hospital::insert([//10
            "name" => "Haykal Hospital",
            "city_id" => "2",
            "long" => "34.4132645736662",
            "lat" => "35.83177320060943"
        ]);
        Hospital::insert([//11
            "name" => "Al Salam Hospital", 
            "city_id" => "2",
            "long" => "34.42222651674446",
            "lat" => "35.827160649733486"
        ]);
        Hospital::insert([//12
            "name" => "Baalbak Hospital",
            "city_id" => "8",
            "long" => "33.99935939739805",
            "lat" => "36.213727355195736"
        ]);
        Hospital::insert([//13
            "name" => "Hiram Hospital",
            "city_id" => "6",
            "long" => "33.282584370569836",
            "lat" => "35.22264276122027"
        ]);
        Hospital::insert([//14
            "name" => "Mount Lebanon Hospital",
            "city_id" => "7",
            "long" => "33.86010250707405",
            "lat" => "35.523922827788425"
        ]);
        Hospital::insert([//15
            "name" => "Bchamoun Hospital",
            "city_id" => "7",
            "long" => "33.783633212262714",
            "lat" => "35.52332864213094"
        ]);

        // Blood_request seeders
        // Blood_request::insert([
        //     "user_id" => 1,
        //     "blood_type_id" => 2,
        //     "city_id" => 7,
        //     "hospital_id" => 8,
        //     "number_of_units" => 1,
        //     "left_number_of_units" => 1,
        //     "expiry_date" => "2021-11-20",
        //     "is_closed" => 0,
        // ]);

        // Blood_request::insert([
        //     "user_id" => 2,
        //     "blood_type_id" => 4,
        //     "city_id" => 3,
        //     "hospital_id" => 4,
        //     "number_of_units" => 1,
        //     "left_number_of_units" => 1,
        //     "expiry_date" => "2021-10-24",
        //     "is_closed" => 0,
        // ]);

        // Blood_request::insert([
        //     "user_id" => 3,
        //     "blood_type_id" => 6,
        //     "city_id" => 2,
        //     "hospital_id" => 5,
        //     "number_of_units" => 2,
        //     "left_number_of_units" => 1,
        //     "expiry_date" => "2021-10-20",
        //     "is_closed" => 0,
        // ]);

        // Blood_request::insert([
        //     "user_id" => 4,
        //     "blood_type_id" => 8,
        //     "city_id" => 9,
        //     "hospital_id" => 9,
        //     "number_of_units" => 1,
        //     "left_number_of_units" => 1,
        //     "expiry_date" => "2021-10-20",
        //     "is_closed" => 0,
        // ]);

        // Donation seeders
        // Donation::insert([
        //     "user_id" => 1,
        //     "blood_request_id" => 2,
        //     "is_accepted" => 0
        // ]);

        // Donation::insert([
        //     "user_id" => 2,
        //     "blood_request_id" => 2,
        //     "is_accepted" => 0
        // ]);

        // Donation::insert([
        //     // "user_id" => 3,
        //     // "blood_request_id" => 3,
        //     // "is_accepted" => 0
        // ]);

        // Donation::insert([
        //     // "user_id" => 4,
        //     // "blood_request_id" => 4,
        //     // "is_accepted" => 0
        // ]);

        // // Connection seeders
        // Connection::insert([
        //     "user_id1" => 1,
        //     "user_id2" => 2
        // ]);
        
        // Connection::insert([
        //     "user_id1" => 2,
        //     "user_id2" => 1
        // ]);

        // Connection::insert([
        //     "user_id1" => 1,
        //     "user_id2" => 3
        // ]);

        // Connection::insert([
        //     "user_id1" => 3,
        //     "user_id2" => 1
        // ]);


        // Message seeders
        // Message::insert([
        //     "connection_id" => 1,
        //     "sender_id" => 1,
        //     "receiver_id" => 2,
        //     "message_body" => "Hi Nader! how are you?"
        // ]);

        // Message::insert([
        //     "connection_id" => 1,
        //     "sender_id" => 2,
        //     "receiver_id" => 1,
        //     "message_body" => "Hello Ahmad! I'm good?"
        // ]);

        // Message::insert([
        //     "connection_id" => 1,
        //     "sender_id" => 1,
        //     "receiver_id" => 2,
        //     "message_body" => "Are you coming to donate today?"
        // ]);

        // Message::insert([
        //     "connection_id" => 1,
        //     "sender_id" => 2,
        //     "receiver_id" => 1,
        //     "message_body" => "Yes sure! I'll be there by 12pm"
        // ]);

        // Message::insert([
        //     "connection_id" => 1,
        //     "sender_id" => 1,
        //     "receiver_id" => 2,
        //     "message_body" => "Great! Seeya"
        // ]);

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
