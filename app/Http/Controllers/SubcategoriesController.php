<?php

namespace App\Http\Controllers;

use App\subcategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use DateTime;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    protected function storeValidator($data)
    {
        $data->validate([
            'subcategory_name' => 'required|string'             
        ]);
        return NULL;
    }

    protected function storeAction($data)
    {
        $cover = $data->file('subcategory_img');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getFilename().'.'.$extension, File::get($cover));
        subcategories::insert([
            'category_id'=> $data->category,
            'subcategory_name'=>$data->subcategory_name,
            'image' => $data->subcategory_img,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invalid = $this->storeValidator($request);
        if(!empty($invalid))
        {
            $request->session()->flash('flashFailure', $invalid);
            return redirect()->back()->withInput($request->input());
        }
        $this->storeAction($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function show(subcategories $subcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function edit(subcategories $subcategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subcategories $subcategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy(subcategories $subcategories)
    {
        //
    }
}
