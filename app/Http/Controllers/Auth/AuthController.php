<?php

namespace App\Http\Controllers\Auth;

use App\Instructor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;
use File;
use SocialiteProviders;
use Config;

class AuthController extends Controller
{
    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */


    public function redirectToProvider($provider, $type)
    {
        $redirectURL= url('/auth/'.$provider.'/callback/'.$type);



        if($provider == 'facebook'){
            Config([

                // in case you would like to overwrite values inside config/services.php
                'services.facebook.redirect'     => $redirectURL,

            ]);


            $this->changeEnv([
                'FACEBOOK_CALLBACK_URL' => $redirectURL

            ]);
        }elseif($provider == 'google'){
            Config([

                // in case you would like to overwrite values inside config/services.php
                'services.google.redirect'     => $redirectURL,

            ]);


            $this->changeEnv([
                'GOOGLE_CALLBACK_URL' => $redirectURL

            ]);
        }



        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider, $type, Request $request)
    {
        //dd($request);
        try{
            $user = Socialite::driver($provider)->user();
        }catch(\Exception $ex){
            if(!$request->has('code') || $request->has('denied')) {
                return redirect('/');
            }
            $user = Socialite::driver($provider)->stateless()->user();
        }

        $authUser = $this->findOrCreateUser($user, $provider, $type);

        if($authUser == '-1'){

            return redirect()->intended('/login')->with('error',__('backend.user_not_exist_please_register_first'));

        }
        Auth::login($authUser, true);

        if($authUser->role == 'instructor'){
            $instructor = Instructor::where('user_id', $authUser->id)->count();
            if($instructor ==0){
                return redirect()->intended('/tutor/registration/steps');

            }else{
                return redirect()->intended('/tutor/lessons/'.$authUser->id);
            }
        }

        /**
		* redirect to user page if the logged in user role is partner
		*/
		if($authUser->role == 'partner'){
            return redirect()->intended('/user');
        }
		
		if($authUser->role == 'admin'){
            return redirect()->intended('/admins');
        }

        return redirect()->intended('/find/tutor');
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider, $type)
    {
        if($user->email == Null){
            //$user->email = $user->id.'@facebook.com';
            return redirect()->intended('/login')->with('error',__('backend.no_email_returned_from_facebook'));
        }
        $authUser = User::where('email', $user->email)->first();

        // check if the type is login return error in case of no record
        if($type =='login' && !$authUser){
            return -1;
        }

        $providerField = "{$provider}_id";
        if($authUser){
            if ($authUser->{$providerField} == $user->id) {
                $authUser->email_verified_at = \Carbon\Carbon::now()->toDateTimeString();
                $authUser->save();
                return $authUser;
            }
            else{
                $authUser->{$providerField} = $user->id;
                $authUser->email_verified_at = \Carbon\Carbon::now()->toDateTimeString();
                $authUser->save();
                return $authUser;
            }
        }

        if($user->avatar != NULL && $user->avatar != ""){
            $fileContents = file_get_contents($user->getAvatar());
            $user_profile = File::put(public_path() . '/images/user_img/' . $user->getId() . ".jpg", $fileContents);
            $name = $user->getId() . ".jpg";
        }
        else {
            $name = NULL;
        }

        $verified = \Carbon\Carbon::now()->toDateTimeString();

        return User::create([
            'fname'     => $user->name,
            'email'    => $user->email,
            'user_img'    => $name,
            'email_verified_at'  => $verified,
            'role'  => $type,
            $providerField => $user->id,
        ]);
    }


    protected function changeEnv($data = array()){
        {
            if ( count($data) > 0 ) {

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);;

                // Loop through given data
                foreach((array)$data as $key => $value){
                    // Loop through .env-data
                    foreach($env as $env_key => $env_value){
                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if($entry[0] == $key){
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;

            } else {

                return false;
            }
        }
    }
}
