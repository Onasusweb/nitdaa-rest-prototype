<?php

class Api_Service_Bitly extends Api_Service_IService {

    private $_username = "yourusername";
    private $_apikey = "yourapikey";
    private $_request = 'http://api.bit.ly/v3/shorten?login=%s&apiKey=%s&longUrl=%s&format=json';

    public function execute($params, $config) {
        $response = file_get_contents(sprintf($this->_request, $this->_username, $this->_apikey, "http://www.amitinside.com"));
        $object = json_decode($response);
        return $object->data->url;
    }

}