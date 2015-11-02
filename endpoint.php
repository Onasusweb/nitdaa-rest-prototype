<?php

session_start();
error_reporting(0);

/**
 * Access point for all API calls
 */
set_include_path('.' . PATH_SEPARATOR .
        './library/NITDAA_Example' . PATH_SEPARATOR .
        './library/Api'
);

require_once ("library/Api/Bootstrap.php");
require_once ("library/NITDAA_Example/NITDAA_API.php");

// Fix json encode for older PHP version than 5.2
require_once ("library/Json/Encoder.php");

// Create request object
$request = new Api_Request("http://localhost/NITDAA_REST/");
$request->setParams(array("version", "service", "method"));
$request->analyze();

// Load config
$config = parse_ini_file("config.ini", true);

// Create Custom api instance
$api = new NITDAA_API();

// Add modify config hook
$api->addHook("Api_Hook_ConfigModify", Api_Hook_IHook::HOOK_CONFIG_LOADED);
$api->addHook("Api_Hook_BlockIp", Api_Hook_IHook::HOOK_BEFORE_SERVICE_EXECUTE);
$api->addHook("Api_Hook_RequestLimit", Api_Hook_IHook::HOOK_BEFORE_SERVICE_EXECUTE);
$api->addHook("Api_Hook_ParserModify", Api_Hook_IHook::HOOK_MODIFY_PARSER);

// Handle api request and catch errors
try {
    $api->handle($request, $config);
} catch (Api_Error $error) {
    $response = new Api_Response(
            $error->getCode(), null, $error);
    $api->send($response);
}

