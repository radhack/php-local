<?php

$a = session_name();

if (empty($a)) {
    session_start();
    echo 'session started successfully';
}
if ($hfapi == 1) {
    $api_key = getenv('HFAPI_HS_APIKEY') ? getenv('HFAPI_HS_APIKEY') : '';
    $client_id = getenv('HFAPI_HS_CLIENT_ID') ? getenv('HFAPI_HS_CLIENT_ID') : '';
} elseif ($freeapi == 1) {
    $api_key = getenv('HS_FREE_APIKEY') ? getenv('HS_FREE_APIKEY') : '';
    $client_id = getenv('HS_FREE_CLIENT_ID') ? getenv('HS_FREE_CLIENT_ID') : '';
} else {
    $api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';
    $api_key_1 = getenv('HS_APIKEY_MY_PROD') ? getenv('HS_APIKEY_MY_PROD') : '';
    $client_id = getenv('HS_CLIENT_ID_LOCAL') ? getenv('HS_CLIENT_ID_LOCAL') : '';
//    $client_id = 'eba963c9302dbc5c91d07ac3fe100c18';
//    $client_id = 'd4b5e20504531509d49e31c5f5bfae62';
}

$sendgrid_api_key = getenv('SENDGRID_PHP_APIKEY') ? getenv('SENDGRID_PHP_APIKEY') : '';
$hw_apikey_test = getenv('HW_APIKEY_TEST') ? getenv('HW_APIKEY_TEST') : '';
//$ld_client = getenv('ld_client') ? getenv('ld_client') : '';
//$ld_client = new LaunchDarkly\LDClient(getenv('ld_client'));