<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Health_record extends Model
{
    protected $table = "health_records";

    public function users(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
