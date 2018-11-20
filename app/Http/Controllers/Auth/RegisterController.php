<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
    protected $redirectTo = '/';

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
     * @param  array $data
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
     * @param  array $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
        try {
            $birthDate = Carbon::parse($data['birth_date']);
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'avatar' => 'null',
                'birth_date' => $birthDate,
                'country_id' => $data['country_id'],
                'sms_subscribe' => $data['sms_subscribe'],
                'email_subscribe' => $data['email_subscribe'],
                'password' => Hash::make($data['password']),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function showRegistrationForm(Request $request)
    {
        $typeDevice = $request->get('typeDevice');
        return view($typeDevice . '.login.register');
    }


}
