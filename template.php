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

$api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';

$client = new HelloSign\Client("$api_key");
$templatefields = $client->getTemplate('5f5650f1cbfd497393cfa426d7d8d81e2a62a1f4');

print_r($templatefields);

