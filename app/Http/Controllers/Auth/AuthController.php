<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Auth;
use Socialite;
use Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/welcome';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $validate = Validator::make($request->all(), User::$rules);
            if($validate->passes()){
                $save = User::saveuser($request);
                if ($save === true)
                    Auth::guard($this->getGuard())->login($this->create($request->all()));
                    return  response()->json(['success'=>'Your Registration was Successfully']);
                return response()->json(['invalid'=> true, 'msg'=> 'An error occurred while saving. Please Retry']); 
            }
            return response()->json(['invalid'=>true, 'errors'=> $validate->messages()]);
        }
    }

    public function redirectToProvider($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider){
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreate($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    public function findOrCreate($user,$provider){

        $authUser = User::where('provider_id',$user->id)->first();
        if(count($authUser)){
            return $authUser;
        }

        return User::create([
            'name'=>$user->name,
            'email'=> $user->email,
            'provider'=>$provider,
            'provider_id'=>$user->id]);
    }

     //I wrote this function to overwrite the default laravel login Behaviour 
    // Daniel Uche Daniel
     public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);

        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);

        if($request->ajax()){
            return response()->json(['invalid'=>true, 'msg'=> $message], 401);
        }
        
        redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => $message]); 
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        if($request->wantsJson()){
            //Get the intended url i stored earlier
            $intendedUrl = $request->session()->get('url.intended');

            return response()->json(['success'=>true, 'redirectUrl'=>'welcome']);
        }
        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath()); 
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if($request->wantsJson()){
            return response()->json(['invalid'=>true, 'msg'=> Lang::get('auth.failed')], 403);
        }
       return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]); 
    }
}
