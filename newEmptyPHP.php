<?php

// session_start();
//header('Content-Type: application/json');
//require_once 'vendor/autoload.php';
//$client = new HelloSign\Client('5b96fc261226d93acfd641dcf7fa04cedc6d87aeeec9d987ec0eb2b8f9a1fbd2');
//if (isset($_SESSION['signature_id'])) {
//	try {
////              $client = new HelloSign\Client('5b96fc261226d93acfd641dcf7fa04cedc6d87aeeec9d987ec0eb2b8f9a1fbd2');
////		$client = new HelloSign\Client($api_key);
//		$embedded_response = $client->getEmbeddedSignUrl($_SESSION['signature_id']);
//		$sign_url = $embedded_response->getSignUrl();
//		echo json_encode($sign_url);
//	} catch (Exception $e) {
//		if ($e->getMessage() == "This request has already been signed") {
//			$filename = "downloaded_files/".$_SESSION['signature_request_id'].".pdf";
//			$client = new HelloSign\Client($api_key);
//			$file = $client->getFiles($_SESSION['signature_request_id'], $filename , HelloSign\SignatureRequest::FILE_TYPE_PDF);
//			echo "<iframe src=\"$filename\" width=\"100%\" style=\"height:880px\"></iframe>";
//		} else {
//                    print_r($e->getMessage());
//		}
//	}
//} else {
////	$client = new HelloSign\Client('5b96fc261226d93acfd641dcf7fa04cedc6d87aeeec9d987ec0eb2b8f9a1fbd2');
//
////	$account = $client->getAccount();
////	//echo '<pre>';
////	//print_r($account);
////	//echo '</pre>';
////
////	$templates = $client->getTemplates($page_number);
////	foreach ($templates as $template) {
////	//	echo $template->getTitle() . "<br>";
////	//        echo $template->getId() . "<br>";
////	}
//
//	//$name = $_GET['name'];
//	//$email = $_GET['email'];
////	$name = $_POST['name'];
////	$email = $_POST['email'];
//        $name = "Alex Testing";
//        $email = "alex@hellosign.com";
//	$client_id = "4c14dad36f89f85c130fb2f7f3857bbc";
//
//	$request = new HelloSign\TemplateSignatureRequest;
//	//$request->enableTestMode();
//	$request->setTemplateId('978790c06a70faeda2cfc7a61815ffc9162cdac2');
//	$request->setSubject('Fiduciary Oath  and Fee Only Agreement');
//	$request->setMessage('');
//	$request->setSigner('Advisor', $email, $name);
//
//	//$response = $client->sendTemplateSignatureRequest($request);
//
//
//	// Turn it into an embedded request
//	$embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);
//
//	// Send it to HelloSign
//	$response = $client->createEmbeddedSignatureRequest($embedded_request);
//
//	// Get the id for a session
//	$signature_request_id = $response->signature_request_id;
//	$_SESSION['signature_request_id'] = $signature_request_id;
//
//	// Grab the signature ID for the signature page that will be embedded in the
//	// page (for the demo, we'll just use the first one)
//	$signatures   = $response->getSignatures();
//	$signature_id = $signatures[0]->getId();
//
//	$_SESSION['signature_id'] = $signature_id;
//
//	// Retrieve the URL to sign the document
//	$response = $client->getEmbeddedSignUrl($signature_id);
//
//	// Store it to use with the embedded.js HelloSign.open() call
//	$sign_url = $response->getSignUrl();
//
//	//echo 'sign url:', $sign_url;
//
//	//echo json_encode(array($email, $name, $sign_url));
//	echo json_encode($sign_url);
//}

require_once 'vendor/autoload.php';

$client = new HelloSign\Client("");

$signature_request_id = "9eab1549a21ddd7a4f9ecedb58a320d120225ba0";

//$full_filename = '/home/p26h9st4/docs/tam/'.strtolower($co)."/$firstname $lastname $filename.zip"; 
//$full_filename = preg_replace('/[^a-z0-9._()\/ ]+/i', '', $full_filename); 
$sig_req_id = "downloaded_files/derp$signature_request_id.zip";

$client->getFiles("9eab1549a21ddd7a4f9ecedb58a320d120225ba0", $sig_req_id, HelloSign\SignatureRequest::FILE_TYPE_ZIP);

echo("<br />");
print_r($sig_req_id);

echo("<br /> success!");