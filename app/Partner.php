<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Partner extends Model
{
    protected $fillable=[
    	'name', 'emailid', 'phoneno', 'address', 'status',
    ];
}
