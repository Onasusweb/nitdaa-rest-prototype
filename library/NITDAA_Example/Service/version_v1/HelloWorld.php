<?php

/**
 * This is an example class for NITDAA REST API
 */
class NITDAA_Example_Service_Helloworld extends Api_Service_IService {

    /**
     * A name for this service
     * This is the name for this service that is used in errors
     * that will be shown to the users and in the log files
     * @var string
     */
    protected $_name = "HelloWorld";

    /**
     * Construct
     * @param Api $api
     */
    public function __construct($api) {
        parent::__construct($api);

        // Set request methods
        $this->addAllowedMethod("execute", Api_Request::METHOD_POST);
        $this->addAllowedMethod("with", Api_Request::METHOD_GET);
        $this->addAllowedMethod("arrayLanguages", Api_Request::METHOD_GET);
        $this->addAllowedMethod("objectLanguages", Api_Request::METHOD_GET);
        $this->addAllowedMethod("getConfigValue", Api_Request::METHOD_GET);
    }

    /**
     * Show the string "Hello World!"
     * 
     * @param array $params	Parameters that are submitted
     * @param array $config	Api config
     */
    public function execute($params, $config) {
        $this->code = 200;
        return array("A"=>12, "B"=>13);
    }

    /**
     * Say hello with a name
     * 
     * @input string name The name you want to use to say hello
     * 
     * @param array $params	Parameters that are submitted
     * @param array $config	Api config
     */
    public function with($params, $config) {

        // Check if parameters isset
        if (!isset($params['name'])) {
            throw new Api_Error(Api_Error::MISSING_PARAMETERS, 'name');
        }

        $this->code = 200;
        return 'Hello, ' . $params['name'] . '!';
    }

    /**
     * Say hello world in different languages based on a array
     * 
     * @param array $params	Parameters that are submitted
     * @param array $config	Api config
     */
    public function arrayLanguages($params, $config) {
        $this->code = 200;
        return array('english' => 'Hello World!',
            'dutch' => 'Hallo Wereld!',
            'french' => 'Bonjour tout le monde!');
    }

    /**
     * Say hello world in different languages based on a object
     * 
     * @param array $params	Parameters that are submitted
     * @param array $config	Api config
     */
    public function objectLanguages($params, $config) {
        $this->code = 200;
        return new HelloWorld();
    }
    /**
     * Getting values from config.ini
     * 
     * @param array $params	Parameters that are submitted
     * @param array $config	Api config
     */
    public function getConfigValue($params, $config){
        
        $this->code = 200;
        return $config['nitdaa'];
    }

}

/**
 * Example class used in the objectLanguages method above
 */
class HelloWorld {

    public $english = 'Hello World!';
    public $dutch = 'Hallo Wereld!';
    public $french = 'Bonjour tout le monde!';

}