<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = Adoption::where('petid', $request->input('petid'))->where('user_id', $request->input('user_id'))->first();
        $input->status = 'accepted';
        $petid = $request->input('petid');
        foreach (Adoption::where('petid', $petid)->get() as $adoption) {
            if($adoption ->user_id != Auth::id()) {
                $adoption -> status = 'rejected';
                $adoption -> save();
            }
        }
            $input->save();
        return back()->with('success', 'Pet adoption request has been sent, processing review');

        $availablePet = Animal::where('id', $request->input('petid'))->get()->first();
        $availablePet->available =  'no';
        $availablePet->save();

    }

    public function store(Request $request)
    {
        $adoption = new Adoption();
        $adoption->user_id = Auth::user()->id;
        $adoption->petid = $request->input('petid');


        // save the Animal object
        $adoption->save();
        // generate a redirect HTTP response with a success message
        return back()->with('success', 'Animal has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adoptions = Adoption::all()->toArray();
        return view('adoptions.index', compact('adoptions'));
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
        $input = Adoption::where('petid', $request->input('petid'))->where('user_id', $request->input('user_id'))->get()->first();
      $input->status = 'rejected';
      $input ->save();
      return back()->with('success', 'Animal has been added');
    }

    public function acceptView()
    {
        $adoptions = Adoption::all();
        return view('adoptions.accepted', compact('adoptions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myAdoptions()
    {
        $adoptions = Adoption::all();
        return view('adoptions.useradopt', compact('adoptions'));
    }


}
