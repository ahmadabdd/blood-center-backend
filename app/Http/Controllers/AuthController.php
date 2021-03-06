<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Health_record;
use App\Models\City;
use App\Models\Blood_type;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Config;
use JWTAuth;

class AuthController extends Controller {

    function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
		if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

		try{
			if(!$token = JWTAuth::attempt($validator->validated())){
				return response()->json(array(
					"status" => false,
					"errors" => 'Invalid Credentials!'
				), 401);
				}
		}catch(JWTException $e){
			return json_encode(["error" => "Error occured"]);
		}
		
        //adding the needed data to the user
		$user = JWTAuth::user();
		$user->token = $token;
        $firebase_token = $user->firebase_token;
        $health_record = Health_record::where('user_id', $user->id)->get();
        $is_available = $health_record[0]->is_available;
        $blood_type_id = $health_record[0]->blood_type_id;
        $blood_type = Blood_type::where('id', $blood_type_id)->get('type');

        
        $city_data = City::where('id', $user->city_id)->get();
        $long = $city_data[0]->long;
        $lat = $city_data[0]->lat;

        $user['is_available'] = $is_available;
        $user['long'] = $long;
        $user['lat'] = $lat;
        $user['token_firebase'] = $firebase_token;
        if($blood_type_id) {
            $user['blood_type'] = $blood_type[0]['type'];
        }

		return response()->json([
            'status' => true,
            'message' => 'User successfully logged in',
            'user' => $user,
        ], 201);
	}


    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|between:2,100',
            'last_name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'city_id' => 'required|integer',
            'firebase_token' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array(
                "status" => false,
                "errors" => $validator->errors()
            ), 400);
        }                                       
        
        $user = User::insert([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'city_id' => $request->city_id,
            'firebase_token' => $request->firebase_token,
            'profile_picture_url' => "https://blood-center.tk/storage/822kdtuWl7Mz.jpg",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        $user_id = User::where('email', $request->email)->get('id');

        Health_record::insert([
            'user_id' => $user_id[0]->id,
            'blood_type_id' => null,
            'date_of_birth' => null,
            'last_donation' => null,
            'is_available' => 0,
            'is_smoker' => null,
            'have_tattoo' => null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        return response()->json([
            'status' => true,
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return response()->json(JWTAuth::user());
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}