<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blood_request;


class WebController extends Controller
{
    public function getApos() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 1)->count();
        return $apos;
    }

    public function getAneg() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 2)->count();
        return $apos;
    }

    public function getBpos() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 3)->count();
        return $apos;
    }

    public function getBneg() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 4)->count();
        return $apos;
    }

    public function getABpos() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 5)->count();
        return $apos;
    }

    public function getABneg() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 6)->count();
        return $apos;
    }

    public function getOpos() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 7)->count();
        return $apos;
    }

    public function getOneg() {
        $apos = Blood_request::select('blood_type_id')->where('blood_type_id', 8)->count();
        return $apos;
    }

}
