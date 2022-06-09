<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Session;

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
  //  protected $redirectTo = RouteServiceProvider::HOME;
   public function redirectTo(){
    Session::flash('success', 'Pendaftaran sudah berhasil');   
    return "/login";
   } 
 

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
          //  'nomer' => ['required', 'digits:12'],
            'nomer' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'size:12'],
            'nik' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'size:16', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([

            'nama_lengkap' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nik'=>$data['nik'],
            'alamat'=>$data['alamat'],
            'nomer_hp'=>$data['nomer'],
            'kota'=>$data['kota'],
            
        ]);
    }

}
