<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users)
    {
        $users = User::paginate(10);
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'alpha_num'],
            'gender' => ['required', 'string'],
            'address' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'profile_picture' => ['required','mimes:jpeg,png,jpg'],
            'role' => ['required'],
        ]);

        $file = $request->file('profile_picture');
        $file_name = uniqid() . "-" . $file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'gender' => $request['gender'],
            'address' => $request['address'],
            'dob' => $request['dob'],
            'profile_image' => $file_name,
            'role' => $request['role'],
        ]);

        $user->save();

        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        // dd($user);
        return view('user.edit', compact('user'));
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
        /* update data */

        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email,'.$id.',id',
            'password' => 'required|string|min:6|alpha_num|confirmed',
            'gender' => 'required',
            'address' => 'required',
            'dob' => 'required|date',
            'picture' => 'required|mimes:jpeg,png,jpg',
            'role' => 'required'
        ]);

        $file = $request->file('profile_picture');
        $file_name = uniqid() . "-" . $file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->picture = $file_name;

        $user->save();

        // return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        /* delete user */
        $user = User::find($request->id);
        $user->delete();
        return redirect('/admin/user');
    }
}
