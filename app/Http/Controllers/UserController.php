<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use JWTAuth;
use Carbon\Carbon;

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
        // $user = JWTAuth::user();
        // $id = $user->id;
        // return json_encode(JWTAuth::user());

        $users = User::with('health-records')->find(1);
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

    public function get_user_info() {
        $user = JWTAuth::user();
        $id = $user->id;

        $user_data = DB::table('users')
                       ->where('users.id', $id)
                       ->join('health_records', 'users.id', '=', 'health_records.user_id')
                       ->join('blood_types', 'health_records.blood_type_id', '=', 'blood_types.id')
                       ->join('cities', 'users.city_id', '=', 'cities.id')
                       ->select('users.first_name',
                                'users.last_name',
                                'users.email',
                                'cities.name',
                                'blood_types.type',
                                'health_records.date_of_birth',    
                                'health_records.last_donation',    
                                'health_records.is_available',
                                'health_records.is_smoker',
                                'health_records.have_tattoo')
                       ->get();
        return $user_data;
    }

    public function get_user_donations() {
        $user = JWTAuth::user();
        $id = $user->id;

        $user_donations = DB::table('donations')
                               ->where('donations.user_id', $id)
                               ->join('users', 'donations.user_id', '=', 'users.id')
                               ->join('blood_requests', 'donations.blood_request_id', '=', 'blood_requests.id')
                               ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
                               ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
                               ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
                               ->select('donations.id as donation_id', 
                                        'blood_requests.id as blood_request_id', 
                                        'donations.is_accepted',
                                        'users.first_name',
                                        'users.last_name',
                                        'blood_types.type',
                                        'cities.name as city',
                                        'hospitals.name as hospital')
                               ->get();
        return $user_donations;
    }

    public function make_request(Request $request) {
        $id = JWTAuth::user()->id;
        Blood_request::insert([
            'user_id'=> $id,
            'blood_type_id'=> $request->blood_type,
            'hospital_id'=> $request->hospital_id,
            'city_id'=> $request->city_id,
            'number_of_units'=> $request->number_of_units,
            'left_number_of_units'=> $request->number_of_units,
            'expiry_date'=> $request->expiry_date,
            'is_closed'=> '0'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Request sent successfully.',
        ], 201);
    }

    public function close_request(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('blood_requests')
          ->where('id', $request->id)
          ->update([
             'is_closed' => 1
          ]);
                           
        return response()->json([
        'status' => true,
        'message' => 'Request closed.',
        ], 201);
    }

    public function reopen_request(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('blood_requests')
          ->where('id', $request->id)
          ->update([
             'is_closed' => 0
          ]);
                           
        return response()->json([
        'status' => true,
        'message' => 'Request is open again.',
        ], 201);
    }

    public function make_donation(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('donations')
          ->insert([
              'user_id' => $request->user_id,
              'blood_request_id' => $request->blood_request_id,
              'is_accepted' => 0
          ]);

        return response()->json([
        'status' => true,
        'message' => 'Donation request sent successfully.',
        ], 201);
    }

    public function accept_donation_request(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('donations')
          ->where('blood_request_id', $request->blood_request_id)
          ->update([
             'is_accepted' => 1
          ]);
                           
        return response()->json([
        'status' => true,
        'message' => 'Donation request accepted.',
        ], 201);
    }
    
    public function decline_donation_request(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('donations')
          ->where('blood_request_id', $request->blood_request_id)
          ->update([
             'is_accepted' => 0
          ]);
                           
        return response()->json([
        'status' => true,
        'message' => 'Donation request declined.',
        ], 201);
    }

    public function edit_user_info(Request $request) {
        $id = JWTAuth::user()->id;  

        DB::table('users')
          ->where('id', $id)
          ->update([
             'first_name' => $request->first_name,
             'last_name' => $request->last_name,
             'city_id' => $request->city_id,
             'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('health_records')
          ->where('id', $id)
          ->update([
             'blood_type_id' => $request->blood_type_id,
             'date_of_birth' => $request->date_of_birth,
             'last_donation' => $request->last_donation,
             'is_available' => $request->is_available,
             'is_smoker' => $request->is_smoker,
             'have_tattoo' => $request->have_tattoo,
             'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Profile edited successfully.',
        ], 201);
    }

    public function fill_health_record(Request $request) {
        $id = JWTAuth::user()->id;

        return $id;
    }
}
