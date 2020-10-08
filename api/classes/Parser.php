<?php


require_once('Councilor.php');

class Parser
{

    /**
     * @var array set to disable ssl verification
     */
    private $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );

    /**
     * @param $url
     * @return bool|mixed
     */
    public function parseUrl($url){

        stream_context_set_default( [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        if($this->get_http_response_code($url) != "200"){
           return false;
        }

        $json = file_get_contents($url,false);
        $data = json_decode($json);
        return $data;
    }

    /**
     * @param $url
     * @return false|string
     */
    private function get_http_response_code($url) {

        $headers = get_headers($url,1);
        return substr($headers[0], 9, 3);
    }



}