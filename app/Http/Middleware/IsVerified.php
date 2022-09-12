<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;
use Auth;
use App\Time_zone;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $setting = Setting::first();
        $time_zone_name = null;

        if(Auth::check())
        {
            if(Auth::user()->role != "admin")
            {
                if($setting->verify_enable == 1)
                {
                    if(Auth::user()->email_verified_at == NULL)
                    {
                        return redirect()->route('verification.notice');
                    }
                    else{

                        return $next($request);
                    }
                }
                else
                {
                    return $next($request);
                }
            }
            else
            {
                return $next($request);
            }
        }
        else
        {

            $ip = $_SERVER['REMOTE_ADDR'];
            if($ip != '127.0.0.1'){
                $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
                $ipInfo = json_decode($ipInfo);
                $ZoneTime = $ipInfo->timezone;
                $ZoneTime= Time_zone::where('time_zone_name', $ZoneTime)->first();
                if(isset($ZoneTime)){
                    $time_zone_name = $ZoneTime->time_zone_name;
                    $timeZone = explode(':', $ZoneTime->time);
                    $ZoneTime=$ZoneTime->time;
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
            session(['currentTimeZoneName' => $time_zone_name ? $time_zone_name : "Africa/Cairo"]);
            session(['currentTimeZone' => $ZoneTime]);
            session(['currentTimeZoneHour' => $timeZone[0]]);
            session(['currentTimeMinutes' => $timeZone[1]]);
            return $next($request);
        }
    }
}
