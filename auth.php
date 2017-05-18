<?php

$a = session_id();
if (empty($a)) {
    session_start();
}
$api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';
$client_id = getenv('HS_CLIENT_ID_LOCAL') ? getenv('HS_CLIENT_ID_LOCAL') : '';
//$client_id = 'eba963c9302dbc5c91d07ac3fe100c18';
$sendgrid_api_key = getenv('SENDGRID_PHP_APIKEY') ? getenv('SENDGRID_PHP_APIKEY') : '';