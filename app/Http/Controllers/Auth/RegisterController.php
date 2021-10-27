<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Admin;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
    }

    public function showAdminRegisterForm()
    {
        return view('admin.auth.register', ['url' => 'admin']);
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('admin/login');
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
            'country_code' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'total_amt' => ['required', 'integer'],
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
        function generateUniqueNumber() {
            $unumber = mt_rand(1000, 9999); // better than rand()
            if (transcodeNumExists($unumber)) {
                return generateUniqueNumber();
            }
           $unique_key = 'KPAY'.''.$unumber;
            return $unique_key;
        }

        function transcodeNumExists($unique_key) {
            return User::where('unique_key',$unique_key)->exists();
        }
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'country_code' => $data['country_code'],
                'mobile' => $data['mobile'],
                'trans_type' => 'kinney_pay',
                'is_admin' => '0',
                'total_amt' => 100,
                'unique_key' => generateUniqueNumber(),
                'password' => Hash::make($data['password']),
            ]);
       
    }
}
