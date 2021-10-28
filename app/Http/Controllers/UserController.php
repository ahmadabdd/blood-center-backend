<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Config;




use JWTAuth;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Health_record;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\Hospital;
use App\Models\Blood_request;
use App\Models\Donation;
use App\Models\Notification;
use App\Models\Message;
use App\Models\Connection;

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
        $health_record = Health_record::where('user_id', $user->id)->get();
        $is_available = $health_record[0]->is_available;
        $user['is_available'] = $is_available;
		return $user;
	}

	public function get_blood_types() {
        $blood_types = Blood_type::select('*')->get();
        return $blood_types;
	}

	public function get_cities() {
        $cities = City::select('*')->get();
        return $cities;
	}

    public function get_hospitals(Request $request) {

        if ($request->has('city_id')) {
            $city_id = $request->city_id;
            $hospitals = Hospital::select('*')
                             ->where('city_id', $city_id)
                             ->get();
        return $hospitals;
        }
        $city_id = $request->city_id;
        $hospitals = Hospital::select('*')->get();
        return $hospitals;
        
	}

    public function get_notifications() {
        $id = JWTAuth::user()->id;

        $notifications = Notification::select('*')
                                     ->where('receiver', $id)
                                     ->orderBy('created_at', 'asc') 
                                     ->get();
        return $notifications;
    }

    public function get_all_requests(Request $request) {    

        if($request->has('blood_type_id')) {
            $blood_type_id = $request->blood_type_id;
            $requests = DB::table('blood_requests')
            ->where('blood_requests.is_closed', 0)
            ->where('blood_types.id', $blood_type_id)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date as expiry_date',
                     'blood_types.type',
                     'cities.name as city',
                     'hospitals.name as hospital',
                     'users.first_name',
                     'users.last_name',
                     'blood_requests.created_at')
            ->orderBy('blood_requests.id'. 'desc')         
            ->get();
            return $requests;
        } 
        elseif($request->has('city_id')) {
            $city_id = $request->city_id;
            $requests = DB::table('blood_requests')
            ->where('blood_requests.is_closed', 0)
            ->where('cities.id', $city_id)
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
                     'users.last_name',
                     'blood_requests.created_at')
            ->orderBy('blood_requests.created_at', 'desc')  
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
                     'users.last_name',
                     'blood_requests.created_at')
            ->orderBy('blood_requests.created_at', 'asc')  
            ->get();
        return $requests;
        }
	}

    public function get_request_data(Request $request) {
        $request_id = $request->request_id;
        $request_data = DB::table('blood_requests')
            ->where('blood_requests.id', $request_id)
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
                     'users.last_name',
                     'blood_requests.created_at')
            ->get();
        return $request_data;
    }

    public function get_user_requests() {
        $user = JWTAuth::user();
        $id = $user->id;

        $user_requests = DB::table('blood_requests')
            ->where('user_id', $id)
            ->where('is_closed', 0)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date',
                     'blood_requests.is_closed',
                     'cities.name as city',
                     'hospitals.name as hospital',
                     'blood_types.type',
                     'blood_requests.created_at')
            ->get();
        return $user_requests;
	}

    public function get_user_requests_fulfilled() {
        $user = JWTAuth::user();
        $id = $user->id;

        $user_requests = DB::table('blood_requests')
            ->where('user_id', $id)
            ->where('is_closed', 1)
            ->join('users', 'blood_requests.user_id', '=', 'users.id')
            ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
            ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
            ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
            ->select('blood_requests.id',
                     'blood_requests.left_number_of_units',
                     'blood_requests.expiry_date',
                     'blood_requests.is_closed',
                     'cities.name as city',
                     'hospitals.name as hospital',
                     'blood_types.type',
                     'blood_requests.created_at')
            ->get();
        return $user_requests;
	}

    public function get_request_donations(Request $request) {
        $blood_request_id = $request->request_id;

        $request_donations = DB::table('donations')
                               ->where('blood_request_id', $blood_request_id)
                               ->where('is_accepted', 0)
                               ->join('users', 'donations.user_id', '=', 'users.id')
                               ->join('blood_requests', 'donations.blood_request_id', '=', 'blood_requests.id')
                               ->join('blood_types', 'blood_requests.blood_type_id', '=', 'blood_types.id')
                               ->join('cities', 'blood_requests.city_id', '=', 'cities.id')
                               ->join('hospitals', 'blood_requests.hospital_id', '=', 'hospitals.id')
                               ->select('donations.id', 
                                        'donations.is_accepted',
                                        'users.id as user_id' ,
                                        'users.first_name',
                                        'users.last_name',
                                        'users.profile_picture_url',
                                        'blood_types.type',
                                        'cities.name as city',
                                        'hospitals.name as hospital',
                                        'donations.created_at')
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
                                'users.profile_picture_url',
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
        $id = JWTAuth::user()->id;                                                          

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
                                        'hospitals.name as hospital',
                                        'donations.created_at')
                               ->get();
        return $user_donations;
    }

    public function close_request(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('blood_requests')
          ->where('id', $request->request_id)
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
          ->where('id', $request->request_id)
          ->update([
             'is_closed' => 0
          ]);
                           
        return response()->json([
        'status' => true,
        'message' => 'Request is open again.',
        ], 201);
    }

    public function make_request(Request $request) {
        $id = JWTAuth::user()->id;
        $health_records = Health_record::where('blood_type_id', $request->blood_type)->get();
        $blood_type_id = Blood_type::where('id', $request->blood_type)->get();
        $blood_type = $blood_type_id[0]->type;

        $blood_request = new Blood_request();
        $blood_request->user_id = $id;
        $blood_request->blood_type_id = $request->blood_type;
        $blood_request->hospital_id = $request->hospital_id;
        $blood_request->city_id = $request->city_id;
        $blood_request->number_of_units = $request->number_of_units;
        $blood_request->left_number_of_units = $request->number_of_units;
        $blood_request->expiry_date = $request->expiry_date;
        $blood_request->is_closed = '0';
        $blood_request->save();

        $blood_request_id = $blood_request->id;

        if(count($health_records) > 0) {
            for($i = 0; $i < count($health_records); $i++) {
                $user_ids[] = $health_records[$i]->user_id;
            }

            for($i = 0; $i < count($user_ids); $i++) {
                Notification::insert([
                    'sender' => $id,
                    'receiver' => $user_ids[$i],
                    'blood_request_id' => $blood_request_id,
                    'header' => 'New ' . $blood_type . ' Request',
                    'body' => 'Would you like to donate?',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            }
        }
      
        return response()->json([
            'status' => true,
            'message' => 'Request sent successfully.',
        ], 201);
    }

    public function make_donation(Request $request) {
        $id = JWTAuth::user()->id;

        DB::table('donations')
          ->insert([
              'user_id' => $id,
              'blood_request_id' => $request->blood_request_id,
              'is_accepted' => 0
          ]);

        $receiver = Blood_request::where("id", $request->blood_request_id)->get();
        $receiver_id = $receiver[0]->user_id;

        $user_data = User::where('id', $id)->get();
        $user_first_name = $user_data[0]->first_name;
        $user_last_name = $user_data[0]->last_name;

        DB::table('notifications')
        ->insert([
            'sender' => $id,
            'receiver' => $receiver_id,
            // 'blood_request_id' => $request->blood_request_id,
            'header' => 'New Donor!',
            'body' => $user_first_name . ' ' . $user_last_name . ' is ready to donate!',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
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
          ->where('user_id', $id)
          ->update([
             'is_accepted' => 1
          ]);

        $receiver = Donation::where("blood_request_id", $request->blood_request_id)->get();
        $receiver_id = $receiver[0]->user_id;

        $user_data = User::where('id', $id)->get();
        $user_first_name = $user_data[0]->first_name;
        $user_last_name = $user_data[0]->last_name;

        DB::table('notifications')
        ->insert([
            'sender' => $id,
            'receiver' => $receiver_id,
            'header' => 'Request Accepted',
            'body' => $user_first_name . ' ' . $user_last_name . ' has accepted your donation',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
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
          ->where('user_id', $id)
          ->update([
             'is_accepted' => 2
          ]);

          $receiver = Donation::where("blood_request_id", $request->blood_request_id)->get();
          $receiver_id = $receiver[0]->user_id;
  
          $user_data = User::where('id', $id)->get();
          $user_first_name = $user_data[0]->first_name;
          $user_last_name = $user_data[0]->last_name;
  
          DB::table('notifications')
          ->insert([
              'sender' => $id,
              'receiver' => $receiver_id,
              'header' => 'Request Declined',
              'body' => $user_first_name . ' ' . $user_last_name . ' has declined your donation',
              'created_at' => Carbon::now()->format('Y-m-d H:i:s')
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

        DB::table('health_records')
            ->where("user_id", $id)
            ->update(["blood_type_id" => $request->blood_type_id,
                      "date_of_birth" => $request->date_of_birth,
                      "last_donation" => $request->last_donation,
                      "is_available" => $request->is_available,
                      "is_smoker" => $request->is_smoker,
                      "have_tattoo" => $request->have_tattoo,
                      'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Health record filled successfully.',
        ], 201);
    }

    public function visit_profile(Request $request) {
        $user_id = $request->user_id;

        $user_data = DB::table('users')
                       ->where('users.id', $user_id)
                       ->join('health_records', 'users.id', '=', 'health_records.user_id')
                       ->join('blood_types', 'health_records.blood_type_id', '=', 'blood_types.id')
                       ->join('cities', 'users.city_id', '=', 'cities.id')
                       ->select('users.first_name',
                                'users.last_name',
                                'users.email',
                                'users.profile_picture_url',
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

    public function set_available() {
        $id = JWTAuth::user()->id;

        DB::table('health_records')
          ->where('user_id', $id)
          ->update([
             'is_available' => 1
          ]);
        
        return response()->json([
            'status' => true,
            'message' => 'You are available now.',
        ], 201);
    }
    
    public function set_unavailable() {
        $id = JWTAuth::user()->id;

        DB::table('health_records')
          ->where('user_id', $id)
          ->update([
             'is_available' => 0
          ]);

        return response()->json([
            'status' => true,
            'message' => 'You are not available now.',
        ], 201);
    }

    public function send_message(Request $request) {
        $id = JWTAuth::user()->id;
        $connection_id = $request->connection_id;
        $receiver_id = $request->receiver_id;
        $message = $request->message_body;

        Message::insert([
            'connection_id' =>  $connection_id,
            'sender_id' => $id,
            'receiver_id' => $receiver_id,
            'message_body' => $message,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Sent.',
        ], 201);
    }

    public function get_chats() {
        $id = JWTAuth::user()->id;

        $chats = DB::table('connections')
        //   ->where('user_id1', '!=', $id)
          ->where('user_id1', $id)
          ->join('users', 'connections.user_id2', '=', 'users.id')
          ->select('connections.id',
                   'users.first_name',
                   'users.last_name',
                   'connections.updated_at')
          ->get();

        return $chats;
    }

    // run php artisan storage:link when testing
	public function upload_image(Request $request) {
		$id = JWTAuth::user()->id;
		$image = $request->profile_picture_url;  

    	$imageName = Str::random(12).'.'.'jpg';

		// decode and store image public/storage
		Storage::disk('public')->put($imageName, base64_decode($image));

        DB::table('users')
          ->where('id', $id)
          ->update([
            //  'profile_picture_url' => Config::get('APP_URL') . 'storage/' . $imageName
             'profile_picture_url' => "https://blood-center.tk/storage/" . $imageName
          ]);

          return response()->json([
            'status' => true,
            'message' => 'Profile picture uploaded successfully.',
        ], 201);
	}

}
