<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use JWTAuth;

use App\Models\User;
use App\Models\Health_record;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\Hospital;
use App\Models\Blood_request;
use App\Models\Donation;

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
class UserController extends Controller {

    // testing function. temp.
	public function test() {
        $user = JWTAuth::user();
        $id = $user->id;
        return json_encode(JWTAuth::user());
	}

	public function get_cities() {
        $cities = City::select('*')->get();
        return $cities;
	}

    // to be adjusted. advanced filter search
    // public function get_all_requests() {
    //     $requests = DB::table('blood_requests')
    //         ->where('blood_requests.is_closed', 0)
    //         ->join('users', 'blood_requests.user_id', '=', 'users.id')
    //         ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
    //         ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
    //         ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
    //         ->select('blood_requests.id',
    //                  'blood_requests.left_number_of_units',
    //                  'blood_requests.expiry_date',
    //                  'blood_types.type',
    //                  'cities.name as city',
    //                  'hospitals.name as hospital',
    //                  'users.first_name',
    //                  'users.last_name')
    //         ->get();
    //     return $requests;
	// }

    public function get_all_requests(Request $request) {

        if($request->has('blood_type')) {
            $blood_type = $request->blood_type;
            $requests = DB::table('blood_requests')
            ->where('blood_requests.is_closed', 0)
            ->where('blood_types.type', $blood_type)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date',
                     'blood_types.type',
                     'cities.name as city',
                     'hospitals.name as hospital',
                     'users.first_name',
                     'users.last_name')
            ->get();
            return $requests;
        } 
        elseif($request->has('city')) {
            $city = $request->city;
            $requests = DB::table('blood_requests')
            ->where('blood_requests.is_closed', 0)
            ->where('cities.name', $city)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date',
                     'blood_types.type',
                     'cities.name as city',
                     'hospitals.name as hospital',
                     'users.first_name',
                     'users.last_name')
            ->get();
            return $requests;
        } 
        else {
            $requests = DB::table('blood_requests')
            ->where('blood_requests.is_closed', 0)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date',
                     'blood_types.type',
                     'cities.name as city',
                     'hospitals.name as hospital',
                     'users.first_name',
                     'users.last_name')
            ->get();
        return $requests;
        }
	}

    public function get_user_requests() {
        $user = JWTAuth::user();
        $id = $user->id;

        $user_requests = DB::table('blood_requests')
            ->where('user_id', $id)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date',
                     'blood_requests.is_closed',
                     'cities.name as city',
                     'hospitals.name as hospital')
            ->get();
        return $user_requests;
	}

    public function get_request_donations(Request $request) {
        $blood_request_id = $request->id;

        $request_donations = DB::table('donations')
                               ->where('blood_request_id', $blood_request_id)
                               ->join('users', 'donations.user_id', '=', 'users.id')
                               ->join('blood_requests', 'donations.blood_request_id', '=', 'blood_requests.id')
                               ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
                               ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
                               ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
                               ->select('donations.id', 
                                        'donations.is_accepted',
                                        'users.first_name',
                                        'users.last_name',
                                        'blood_types.type',
                                        'cities.name as city',
                                        'hospitals.name as hospital')
                               ->get();
        return $request_donations;
    }

    public function get_user_donations() {
        $user = JWTAuth::user();
        $id = $user->id;
        return $id;
    }
}
