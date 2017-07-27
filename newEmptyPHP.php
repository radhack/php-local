<?php
require_once 'vendor/autoload.php';
include('auth.php');
echo "<html><head><script type=\"text/javascript\" src=\"//s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js\"></script><title>Embedded Signing</title></head>";

//if (isset($_SESSION['hellosign_oauth'])) {
//    goto skip;
//}
//$client = new HelloSign\Client($api_key);
//$oauth_request = new HelloSign\OAuthTokenRequest(array(
//    'code' => 'c79944967b2f6ad1',
//    'state' => 'somethingrandom',
//    'client_id' => '2d9e5cbc5d888bef3253c0489d6851f5',
//    'client_secret' => '249046db0fd92da7ddcbd1487feb7246'
//        ));
//
//// Request OAuth token for the first time
//$token1 = $client->requestOAuthToken($oauth_request);
//
//// Export token to array, store it to use later
////$hellosign_oauth = $token1->toArray($options);
//$_SESSION['hellosign_oauth'] = $token1;
//print_r($token1);
//
//echo "<br />you got here <br />";
//
//skip:
//$token1 = $_SESSION['hellosign_oauth'];
//// Populate token from array
//$token_response = new HelloSign\OAuthToken($token1);
//
//$token = $token_response->getAccessToken();
//
//
//print_r($token);
//
//echo "<br />you got here too <br />";
//// Provide the user's OAuth access token to the client
//$client_oauth = new HelloSign\Client($token_response);
//
////$signature_requests = $client->getSignatureRequests(1);
//$response = $client_oauth->getAccount();
//print_r($response);
//echo "<br />";
//print_r($response->getWarnings());
//echo "<br />you got more here";

$client = new HelloSign\Client($api_key);
$request = new HelloSign\SignatureRequest;
$request->enableTestMode();

$request->setTitle('NDA with Acme Co.');
$request->setSubject('The NDA we talked about');
$request->setMessage('Please sign this NDA and then we can discuss more. Let me know if you have any questions.');

//$request->addSigner(new HelloSign\Signer(array(
//    'name' => 'Alex',
//    'email_address' => 'alex+email@hellosign.com',
//    'order' => 0
//)));
//
//$request->addSigner(new HelloSign\Signer(array(
//    'name' => 'Charmy',
//    'email_address' => 'alex+signer1@hellosign.com',
//    'order' => 1
//)));

$request->addSigner("alex+signer1@hellosign.com", "Alex Signer 1");
$request->addSigner("alex+signer2@hellosign.com", "Alex Signer 2");

$request->setRequesterEmail("alex@hellosign.com");
$request->addFile("./nda.pdf");

$request->setFormFieldsPerDocument([[
[
    "api_id" => "api_id_1",
    "name" => "For Alex",
    "type" => "text",
    "x" => 5,
    "y" => 10,
    "width" => 100,
    "height" => 20,
    "required" => true,
    "signer" => 0,
    "page" => 1
],
 [
    "api_id" => "api_id_2",
    "name" => "Sign Alex",
    "type" => "signature",
    "x" => 5,
    "y" => 30,
    "width" => 100,
    "height" => 16,
    "required" => true,
    "signer" => 0,
    "page" => 1
],
 [
    "api_id" => "api_id_3",
    "name" => "For Charmy",
    "type" => "text",
    "x" => 120,
    "y" => 10,
    "width" => 120,
    "height" => 20,
    "required" => true,
    "signer" => 1,
    "page" => 1
],
 [
    "api_id" => "api_id_4",
    "name" => "Sign Charmy",
    "type" => "signature",
    "x" => 120,
    "y" => 30,
    "width" => 120,
    "height" => 20,
    "required" => true,
    "signer" => 1,
    "page" => 1
],
    ]
]);

$draft_request = new HelloSign\UnclaimedDraft($request, $client_id);
$draft_request->setIsForEmbeddedSigning(true);
$response = $client->createUnclaimedDraft($draft_request);

$edit_url = $draft_request->getClaimUrl();

//$edit_url .= "&client_id=" . $client_id . "&skip_domain_verification=1&redirect_url=" . urlencode($scriptUrlBase . "complete.php");
//
//$new_template_id = "test";
//
//echo "<pre><b>URL:</b> ";
//echo $edit_url;
//echo "</pre>";
//
//echo "<iframe id='" . $new_template_id . "' src='" . $edit_url . "'></iframe>";

$sign_url = $edit_url;

include('signerpage.php');
?>
<!--<script>
//    var url = 'https://02b35105d83ab3170140283bd44ff05c958c87fa5a7c7346de1eb83d07f3715f:@api.hellosign.com/v3/signature_request/files/148405c73b6f150ad9e4c2555d51c0c02208e153';
var url = 'https://hstests.ngrok.io/callback.php';

var xhttp = new XMLHttpRequest();

xhttp.open("GET", url, true);

xhttp.setRequestHeader("Content-type", "application/json");

xhttp.send();

var response = xhttp.response;

console.log(response);
</script>-->