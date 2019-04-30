<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Freelancer extends Model
{
    protected $fillable=[
    	'name', 'emailid', 'password', 'phoneno', 'address', 'category_id', 'company', 'location', 'lat', 'long', 'serving_distance', 'experience', 'serving_location', 'qualification', 'image', 'doc', 
    ];
}

