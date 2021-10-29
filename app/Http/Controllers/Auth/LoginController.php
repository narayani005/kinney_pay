<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    { 
        return view('admin.auth.login', ['url' => 'admin']);    
    }
    public function showUserLoginForm()
    {  
        return view('auth.login', ['url' => 'userLogin']);
    }
    
    public function showUserRegisterForm(){
        return view('auth.register', ['url' => 'userRegister']);
    }
    public function adminLogin(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        $url = $request->path();
        //if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
                if (auth()->user()->is_admin == 1 ) {
                    return redirect()->route('home');
                }else{
                    return redirect('/admin/login')->with('error', 'Access Denied');
                } 
            }else{
                return redirect()->route('/admin/login')
                    ->with('error','Email-Addr And Password Are Wrong.');
            }
    }
     
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $url = $request->path();
            if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
            {
                if (auth()->user()->is_admin == 1) {
                return redirect()->route('login')->with('error','Access Denied.');
                }else{
                    return redirect()->route('home');
                } 
            }else{
                return redirect()->route('login')
                    ->with('error','Email-Address And Password Are Wrong.');
            }
        
    }
    
    public  function logout(Request $request) {
        if (auth()->user()->is_admin == 1) {
            Auth::logout();
            return redirect('admin/login');
        }else{ 
            Auth::logout();
            return redirect('/login');
        }
      }
}
