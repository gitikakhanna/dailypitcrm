<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Services extends Model
{
    protected $fillable=[
    	'category_id', 'subcategory_id', 'reg_price', 'amc_price', 'discount', 'description', 'reg_service_detail', 'amc_service_detail', 
    ];
}
