<?php

namespace App\Http\Controllers;

use Auth;
use App\Listing;
use App\ListingImage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreListing;
use Illuminate\Support\Facades\Input;

class ListingController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('listing.index', [
            'listings' => Listing::orderBy('created_at', 'desc')->paginate(12)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListing $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListing $request)
    {
        $validData = $request->validated();
        // Store listing
        $listing = Auth::user()->listings()->create($validData);
        // Store image
        $image = new ListingImage([
            'filename' => $validData['image']->storePublicly('listingimages', ['disk' => 'public'])
        ]);
        $listing->image()->save($image);
        // Redirect
        return redirect()->route('listings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('listing.show', [
            'listing' => Listing::with(['image', 'author.userProfile'])->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
    }

    /**
     * Search in resource
     * 
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if (!Input::get('query')) {
            return redirect()->route('listings.index');
        }

        $listings = Listing::searchByQuery([
            'match' => ['title' => Input::get('query')]
        ]);

        return view('listing.index', [
            'listings' => $listings
        ]);
    }
}
