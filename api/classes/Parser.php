<?php


require_once('Councilor.php');

class Parser
{
    const MAX_PAGE = 5;
    const MIN_PAGE = 1;
    const REST_API_URL = 'http://ws-old.parlament.ch/councillors';
    const FILE_URL = "https://politik.ch/dl/councillors.json";

    /**
     * @param $url
     * @return mixed
     */
    public function parseUrl($url){

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);

    }

}