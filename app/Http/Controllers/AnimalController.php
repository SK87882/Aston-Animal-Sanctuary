<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\User;
use Gate;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::all()->toArray();
        return view('animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $accountsQuery = Animal::all();
        // return view('animals.create', array('animals'=>$accountsQuery));
        return view('animals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form validation
        $animal = $this->validate(request(), [
            'name' => 'required',
            'date_of_birth' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'image2' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
            'image3' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:500',
        ]);
        //Handles the uploading of the image
        if ($request->hasFile('image')&& $request->hasFile('image2') && $request->hasFile('image3') ) {
            //Gets the filename with the extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileNameWithExt2 = $request->file('image2')->getClientOriginalName();
            $fileNameWithExt3 = $request->file('image3')->getClientOriginalName();
            //just gets the filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $filename2 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
            $filename3 = pathinfo($fileNameWithExt3, PATHINFO_FILENAME);
            //Just gets the extension
            $extension = $request->file('image')->getClientOriginalExtension();
            $extension2 = $request->file('image2')->getClientOriginalExtension();
            $extension3 = $request->file('image3')->getClientOriginalExtension();
            //Gets the filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $fileNameToStore2 = $filename2 . '_' . time() . '.' . $extension2;
            $fileNameToStore3 = $filename3 . '_' . time() . '.' . $extension3;
            //Uploads the image
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $path2 = $request->file('image2')->storeAs('public/images', $fileNameToStore2);
            $path3 = $request->file('image3')->storeAs('public/images', $fileNameToStore3);
        } else {
            $fileNameToStore = 'noimage.jpg';
            $fileNameToStore2 = 'noimage.jpg';
            $fileNameToStore3 = 'noimage.jpg';
        }

        // create a Animal object and set its values from the input
        $animal = new Animal;
        $animal->name = $request->input('name');
        $animal->description = $request->input('description');
        $animal->animal_type = $request->input('animal_type');
        $animal->species = $request->input('species');
        $animal->date_of_birth = $request->input('date_of_birth');
        $animal->available = $request->input('available');
        $animal->created_at = now();
        $animal->image = $fileNameToStore;
        $animal->image2 = $fileNameToStore2;
        $animal->image3 = $fileNameToStore3;
        // save the Animal object
        $animal->save();
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
        $animal = Animal::find($id);
        return view('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    $animal = Animal::find($id);
    return view('animals.edit',compact('animal'));
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
        $animal = Animal::find($id);
        $this->validate(request(), [
            'name' => 'required',
            'date_of_birth' => 'required'
        ]);
        $animal->name = $request->input('name');
        $animal->date_of_birth = $request->input('date_of_birth');
        $animal->description = $request->input('description');
        $animal->animal_type = $request->input('animal_type');
        $animal->available = $request->input('available');
        $animal->updated_at = now();
        //Handles the uploading of the image
        // if ($request->hasFile('image')&& $request->hasFile('image2') && $request->hasFile('image3')) {
        //     //Gets the filename with the extension
        //     $fileNameWithExt = $request->file('image')->getClientOriginalName();
        //     $fileNameWithExt2 = $request->file('image2')->getClientOriginalName();
        //     $fileNameWithExt3 = $request->file('image3')->getClientOriginalName();
        //     //just gets the filename
        //     $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        //     $filename2 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
        //     $filename3 = pathinfo($fileNameWithExt3, PATHINFO_FILENAME);
        //     //Just gets the extension
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     $extension2 = $request->file('image2')->getClientOriginalExtension();
        //     $extension3 = $request->file('image3')->getClientOriginalExtension();
        //     //Gets the filename to store
        //     $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        //     $fileNameToStore2 = $filename2 . '_' . time() . '.' . $extension2;
        //     $fileNameToStore3 = $filename3 . '_' . time() . '.' . $extension3;
        //     //Uploads the image
        //     $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        //     $path2 = $request->file('image2')->storeAs('public/images', $fileNameToStore2);
        //     $path3 = $request->file('image3')->storeAs('public/images', $fileNameToStore3);
        // } else {
        //     $fileNameToStore = 'noimage.jpg';
        //     $fileNameToStore2 = 'noimage.jpg';
        //     $fileNameToStore3 = 'noimage.jpg';
       // }

       if($request->hasFile('image')){
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->hasFile('image2')){
            $fileNameWithExt2 = $request->file('image2')->getClientOriginalName();
            $filename2 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
            $extension2 = $request->file('image2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename2 . '_' . time() . '.' . $extension2;
            $path2 = $request->file('image2')->storeAs('public/images', $fileNameToStore2);
        } else {
            $fileNameToStore2 = 'noimage.jpg';
        }

        if($request->hasFile('image3')){
            $fileNameWithExt3 = $request->file('image3')->getClientOriginalName();
            $filename3 = pathinfo($fileNameWithExt2, PATHINFO_FILENAME);
            $extension3 = $request->file('image3')->getClientOriginalExtension();
            $fileNameToStore3 = $filename3 . '_' . time() . '.' . $extension3;
            $path3 = $request->file('image3')->storeAs('public/images', $fileNameToStore3);
        } else {
            $fileNameToStore3 = 'noimage.jpg';
        }


        $animal->image = $fileNameToStore;
        $animal->image2 = $fileNameToStore2;
        $animal->image3 = $fileNameToStore3;
        $animal->save();
        return redirect('animals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delAnimal = \App\Models\Adoption::where('petid', $id);
        $delAnimal->delete();

        $animal = Animal::find($id);
        $animal->delete();
        return redirect('animals');
    }

   // public function display()
   // {
     //   $accountsQuery = User::all();
      //  if (Gate::denies('displayall')) {
       //     $accountsQuery = $accountsQuery->where('userid', auth()->user()->id);
       // }
       // return view('/display', array('accounts' => $accountsQuery));
   // }
}
