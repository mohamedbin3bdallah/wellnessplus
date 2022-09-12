<?php

namespace App\Providers;

use App\Language;
use Illuminate\Support\ServiceProvider;
use Schema;
use App\Setting;
use Session;
use App\Currency;
use App\UserTutorBalance;
use App\InstructorSetting;
use App\IP\IP;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            \DB::connection()->getPdo();
            Schema::defaultStringLength(191);
            view()->composer('*',function($view){

                    if(\DB::connection()->getDatabaseName()){
                        if(Schema::hasTable('settings')){
                    $project_title = Setting::first()->project_title;
                    $cpy_txt = Setting::first()->cpy_txt;
                    $gsetting = Setting::first();
                    $currency = Currency::first();
                    $isetting = InstructorSetting::first();
                    $zoom_enable = Setting::first()->zoom_enable;

                    $languages = Language::all();
					
					$userIP = new IP();
					$user_ip_country_info = $userIP->getUserCountryInfo();
					
					if(Auth::check() && Auth::user()->role == 'user')
					{
						$currentRouteAction = Route::currentRouteAction();
						$currentRouteActionFunction = substr($currentRouteAction, strpos($currentRouteAction, '@') + 1);
						switch ($currentRouteActionFunction)
						{
							case "tutorProfile":
								$user_balance = UserTutorBalance::where(['user_id'=>Auth::user()->id,'tutor_id'=>request()->id])->first();
								break;
							case "bookSlots":
								$slot_data = explode(',', request()->slots[0]);
								$user_balance = UserTutorBalance::where(['user_id'=>Auth::user()->id,'tutor_id'=>$slot_data[0]])->first();
								break;
							case "request":
								$user_balance = UserTutorBalance::where(['user_id'=>Auth::user()->id,'tutor_id'=>request()->id])->first();
								break;
							default:
								$user_balance = UserTutorBalance::select(DB::raw('SUM(balance) AS balance'))->where(['user_id'=>Auth::user()->id])->first();
						}
						
						if(!$user_balance)
						{
							$user_balance = new \stdClass();
							$user_balance->balance = 0;
						}
					}
					else
					{
						$user_balance = new \stdClass();
						$user_balance->balance = 0;
					}

                    $view->with([
                        'project_title' => $project_title,
                        'cpy_txt'=> $cpy_txt,
                        'gsetting' => $gsetting,
                        'currency' => $currency,
                        'isetting' => $isetting,
                        'zoom_enable' => $zoom_enable,
                        'languages' => $languages,
						'user_balance' => $user_balance,
						'user_ip_country_info' => $user_ip_country_info
                    ]);
                    }
                }
            });
        }catch(\Exception $ex){

          return redirect('/get/step2');
        }

    }


}
