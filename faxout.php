<?php

/*
 * Copyright (C) 2017 alexgriffen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once 'vendor/autoload.php';
$sendgrid_php_apikey = getenv('SENDGRID_PHP_APIKEY') ? getenv('SENDGRID_PHP_APIKEY') : '';

$sendgrid = new SendGrid($sendgrid_php_apikey);
$url = 'https://api.sendgrid.com/';
$pass = $sendgrid_php_apikey;

$params = array(
    'to' => "14154847772@hellofax.com",
    'toname' => "Testing Outbound Fax",
    'from' => "radhack242@gmail.com",
    'fromname' => "Simple PHP",
    'subject' => "Testing received",
    'html' => "<strong>YASBITCH</strong><br />"
    . "Is how we do it<br />"
    . "was received at RIGHT NOW YO<br />",
);

$request = $url . 'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_php_apikey));
// Tell curl to use HTTP POST
curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);

// print everything out
print_r($response);



echo '<br />';
echo '<a href="index.php">Click here to go home</a>';
