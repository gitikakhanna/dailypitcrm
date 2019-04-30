<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('emailid');
            $table->string('password');
            $table->integer('phoneno');
            $table->string('address');
            $table->integer('category_id');
            $table->string('company');
            $table->string('location');
            $table->unsignedDecimal('lat', 12, 10);
            $table->float('long', 12, 10);
            $table->string('serving_distance');
            $table->integer('experience');
            $table->string('serving_location');
            $table->string('qualification');
            $table->string('image');
            $table->string('doc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freelancers');
    }
}
