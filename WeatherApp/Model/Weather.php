<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Weather
 *
 * @author webre
 */
class Weather implements Weather_Interface {

    private $url;

    public function __construct() {
        $this->url = __WEATHER_URL;
    }

    public function get_cities() {
        $cities = json_decode(file_get_contents(__CITIES_FILE), true);

        $cityList = [];
        foreach ($cities as $city) {
            $cityList[$city['id']] = $city['name'];
        }

        return $cityList;
    }

    public function get_weather($cityId) {
        $url = str_replace('{{cityid}}', $cityId, $this->url);
        $url = str_replace('{{apikey}}', '04b6e55ac56497c4658f7d9cb8418dde', $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json_data = curl_exec($ch);
        curl_close($ch);
        $weather_data = json_decode($json_data, true);

        return $weather_data;
    }

    public function get_current_time() {
        date_default_timezone_set('Africa/Cairo');
        return date('l, H:i:s');
    }

    public function get_current_date() {
        date_default_timezone_set('Africa/Cairo');
        return date('F j, Y');
    }

}
