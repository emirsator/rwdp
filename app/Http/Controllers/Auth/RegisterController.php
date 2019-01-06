<?php

namespace App\Http\Controllers\Auth;

use App\Models\ser;
use App\Models\ole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');

        //Disable registration
        Redirect::to('/')->send();
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => Role::where('name', 'user')->first()->id
        ]);
        
        $user
            ->roles()
            ->attach(Role::where('name', 'user')->first());
        
        \Mail::send('emails.registration', ['email'=>$data['email'], 'password'=>$data['password']], function($message)
        {
            $message->from(env('MAIL_FROM', 'registrierung@tti-stuttgart.de'), 'Registrierung');
            $message->to($data['email'], $data['name'])->subject("Ihre Registrierung beim TTI Stuttgart");

            $encoder = \Swift_Encoding::get7BitEncoding();
            $message->setEncoder($encoder);
            
        });
        
        return $user;
    }
}
