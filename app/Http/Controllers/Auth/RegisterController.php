<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    //digunakan untuk menyimpan request sekarang yang nantinya akan diassign di constructor
    protected $request;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *  redirect user stelah register
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *membuat instance dri controller tersebut
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *validasi utk data yg diinput diregister
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //custom error message
        $messages = [
            'email.max' => 'Email is too long'
        ];
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'alpha_num'],
            'gender' => ['required', 'string'],
            'address' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'profile_picture' => ['required','mimes:jpeg,png,jpg'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *  membuat user dengan data yang telah divalidasikan tadi
     * @param  array  $data
     * @param  Request
     * @return \App\User
     */
    protected function create(array $data)
    {
        $file = $this->request->file('profile_picture');
        $file_name = uniqid() . "-" . $file->getClientOriginalName();
        $file->move(public_path('/images'),$file_name);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'profile_image' => $file_name,
        ]);
    }
}
