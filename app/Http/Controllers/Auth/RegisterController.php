<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
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
     *
     * @var string
     */
    protected $redirectTo = '/tweets';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 追加
            'screen_name' => ['required', 'string', 'max:255', 'unique:users'],
            'name'        => ['required', 'string', 'max:255'],
            // 'image' => ['required', 'file', 'image', 'mimes:png,jpeg'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
    //     if (request()->hasFile('image')) {
    //         $image = request()->file('image')->getClientOriginalName();
    //         request()->file('image')->storeAs('avatars', $image, 'public');
    // }
        return User::create([
            // 追加
            'screen_name' => $data['screen_name'],
            'name' => $data['name'],
            // 'profile_image' => $image,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
