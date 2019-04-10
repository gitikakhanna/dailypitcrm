<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
	protected $fillable=[
    	'name', 'image',
    ];    
}
