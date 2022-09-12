<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\Time_zone;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use App\User;


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
    protected function authenticated()
    {

        if (Auth::User()->status == 1)
        {
            $time_zone_name='';
            if(isset(Auth::user()->timeZone->time)){
                $ZoneTime = Auth::user()->timeZone->time;
                $time_zone_name = Auth::user()->timeZone->time_zone_name;
                $timeZone = explode(':', $ZoneTime);
            }else{

                $ip = $_SERVER['REMOTE_ADDR'];
                if($ip != '127.0.0.1'){
                    $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                    $ipInfo = json_decode($ipInfo);
                    $ZoneTime = $ipInfo->timezone;
                    $ZoneTime= Time_zone::where('time_zone_name', $ZoneTime)->first();
                    $time_zone_name = $ZoneTime->time_zone_name;

                    if(isset($ZoneTime)){

                        $timeZone = explode(':', $ZoneTime->time);
                        $ZoneTime= $ZoneTime->time;
                    }else{
                        $timeZone[0] = "+0";
                        $timeZone[1] = "+0";
                        $ZoneTime="00:00";
                    }

                }else{
                    $timeZone[0] = "+0";
                    $timeZone[1] = "+0";
                    $ZoneTime="00:00";
                }

            }


            session(['currentTimeZoneName' => $time_zone_name ? $time_zone_name : "Africa/Cairo"]);
            session(['currentTimeZone' => $ZoneTime]);
            session(['currentTimeZoneHour' => $timeZone[0]]);
            session(['currentTimeMinutes' => $timeZone[1]]);



            /**
			* redirect to user page if the logged in user role is partner
			*/
			if ( Auth::User()->role == "partner")
            {
                return redirect()->route('user.index');
            }
			
			if ( Auth::User()->role == "admin")
            {
                // do your magic here
                return redirect()->route('admin.index');
            }
            elseif(Auth::User()->role == "instructor")
            {
                $tutor = Instructor::where('user_id', auth()->id())->first();
               // dd($tutor);

                if ($tutor == null){
                    return redirect('/tutor/registration/steps');
                }
                return redirect()->intended(session('page'));
                //return redirect('/tutor/profile');

            }else{
                return redirect()->intended(session('page'));

                return redirect('/find/tutor');
            }
        }
        else{

            Auth::logout();
            return redirect()->route('login')->with('delete',__('backend.you_are_deactivated'));
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();

        // set the remember me cookie if the user check the box
        $remember = (Input::has('remember')) ? true : false;

        // attempt to do the login
        $auth = Auth::attempt(
            [
                'email'  => strtolower(Input::get('email')),
                'password'  => Input::get('password')
            ], $remember
        );

        if ($user) {
            Auth::login($user);
            return redirect()-> action('HomeController@index');
        }
        else {
            return view('auth.register', ['name'=> $userSocial->getName(),
                                            'email' => $userSocial->getEmail()]);
        }
    }
}
