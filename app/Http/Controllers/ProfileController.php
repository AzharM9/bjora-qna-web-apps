<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $profile)
    {
        /* Mencari user yang sedang login */
        // $profile = $user;
        $profile = Auth::user();
        // dd($profile);
        // $profile = User::findOrFail(auth()->id());

        return view('profile.index', ['profile' => $profile]);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = User::findOrFail($id);
        return view('profile.index', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = User::findOrFail($id);
        return view('profile.edit', compact('profile'));
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
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email,'.$id.',id',
            'password' => 'required|string|min:6|alpha_num|confirmed',
            'gender' => 'required',
            'address' => 'required',
            'dob' => 'required|date',
            'picture' => 'required|mimes:jpeg,png,jpg',
        ]);

        $picture = $request->file('picture');
        $pictureName = Str::random(15).'.'.$picture->getClientOriginalExtension();
        $picture->move(public_path().'/'.'files', $pictureName);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->picture = $pictureName;

        $user->save();

        return redirect()->route('profile.index');
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
}
