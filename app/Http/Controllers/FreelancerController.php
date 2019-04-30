<?php

namespace App\Http\Controllers;

use App\Freelancer;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $categories = Category::all();
        $partner = DB::table('partnerrequest')->where('id', $id)->get();    
        return view('freelancer', compact('id', 'categories', 'partner'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('freelancer', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cover = $request->file('profile_img');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename().'.'.$extension, File::get($cover));

        $coverdoc = $request->file('doc_img');
        $extensiondoc = $coverdoc->getClientOriginalExtension();
        Storage::disk('public')->put($coverdoc->getFilename().'.'.$extensiondoc, File::get($coverdoc));

        Freelancer::insert([
            'name' => $request->name,
            'emailid' => $request->emailid,
            'password' => Str::random(8),
            'phoneno' => $request->phoneno,
            'address' => $request->address,
            'category_id' => $request->profession,
            'company' => $request->company,
            'location' => $request->location,
            'lat' => $request->lat,
            'long' => $request->long,
            'serving_distance' => $request->serving_distance,
            'experience' => $request->experience,
            'serving_location' => $request->serving_locations,
            'qualification' => $request->qualification,
            'image' => $cover->getFilename().'.'.$extension,
            'doc' =>  $coverdoc->getFilename().'.'.$extensiondoc,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if(!empty($request->requestid))
        {
            DB::table('partnerrequest')->where('id', $request->requestid)->update(['status' => 1]);    
        }
        
        return redirect('/partnerrequest');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Freelancer  $freelancer
     * @return \Illuminate\Http\Response
     */
    public function show(Freelancer $freelancer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Freelancer  $freelancer
     * @return \Illuminate\Http\Response
     */
    public function edit(Freelancer $freelancer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Freelancer  $freelancer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Freelancer $freelancer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Freelancer  $freelancer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Freelancer $freelancer)
    {
        //
    }
}
