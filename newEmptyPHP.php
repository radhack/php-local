<?php
require_once 'vendor/autoload.php';
include('auth.php');

if (isset($_SESSION['hellosign_oauth'])) {
    goto skip;
}
$client = new HelloSign\Client($api_key);
$oauth_request = new HelloSign\OAuthTokenRequest(array(
    'code' => 'c79944967b2f6ad1',
    'state' => 'somethingrandom',
    'client_id' => '2d9e5cbc5d888bef3253c0489d6851f5',
    'client_secret' => '249046db0fd92da7ddcbd1487feb7246'
        ));

// Request OAuth token for the first time
$token1 = $client->requestOAuthToken($oauth_request);

// Export token to array, store it to use later
//$hellosign_oauth = $token1->toArray($options);
$_SESSION['hellosign_oauth'] = $token1;
print_r($token1);

echo "<br />you got here <br />";

skip:
$token1 = $_SESSION['hellosign_oauth'];
// Populate token from array
$token_response = new HelloSign\OAuthToken($token1);

$token = $token_response->getAccessToken();


print_r($token);

echo "<br />you got here too <br />";
// Provide the user's OAuth access token to the client
$client_oauth = new HelloSign\Client($token_response);

//$signature_requests = $client->getSignatureRequests(1);
$response = $client_oauth->getAccount();
print_r($response);
echo "<br />";
print_r($response->getWarnings());
echo "<br />you got more here";
