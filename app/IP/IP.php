<?php

namespace App\IP;

use App\Allcountry;

class IP
{
	/**
     * Get user country Data by his ip address
     *
     * @return country data
     */
    public function getUserCountryInfo()
    {
        $return = array('country_id'=>'');
        if (isset($_SERVER['REMOTE_ADDR']) and !in_array($_SERVER['REMOTE_ADDR'], array('localhost', '127.0.0.1', '::1')))
		{
            $country = $this->curl_api("http://www.geoplugin.net/json.gp?ip={$_SERVER['REMOTE_ADDR']}");
            if (isset($country['geoplugin_countryCode']) and !empty($country['geoplugin_countryCode']))
			{
				$return = Allcountry::select('id as country_id')->where(['iso'=>$country['geoplugin_countryCode']])->first()->toArray()	;
            }
        }
        return $return;
    }
	
	/**
     * Get required data from outsied using curl
     *
     * @return array of required data
     */
    public function curl_api($url)
    {
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($handle);
        curl_close($handle);
        return json_decode($output, TRUE);
    }
}