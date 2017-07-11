<?php
require_once 'vendor/autoload.php';
$client = new HelloSign\Client('redacted');

$account = $client->getAccount();
echo '<pre>';
print_r($account);
echo '</pre>';

$templates = $client->getTemplates($page_number);
foreach ($templates as $template) {
	echo $template->getTitle() . "<br>";
        echo $template->getId() . "<br>";
}

echo '<hr>';

$client_id = "redacted";

$request = new HelloSign\TemplateSignatureRequest;
$request->enableTestMode();
//$request->setTemplateId($template->getId());
$request->setTemplateId('978790c06a70faeda2cfc7a61815ffc9162cdac2');
$request->setSubject('Purchase Order');
$request->setMessage('Glad we could come to an agreement.');
$request->setSigner('Advisor', '', 'George');
//$request->setCC('Accounting', '');
//$request->setCustomFieldValue('Cost', '$20,000');

//$response = $client->sendTemplateSignatureRequest($request);


// Turn it into an embedded request
$embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

// Send it to HelloSign
$response = $client->createEmbeddedSignatureRequest($embedded_request);

// Grab the signature ID for the signature page that will be embedded in the
// page (for the demo, we'll just use the first one)
$signatures   = $response->getSignatures();
$signature_id = $signatures[0]->getId();

// Retrieve the URL to sign the document
$response = $client->getEmbeddedSignUrl($signature_id);

// Store it to use with the embedded.js HelloSign.open() call
$sign_url = $response->getSignUrl();

echo 'sign url:', $sign_url;
?>
<html>
<head>
<script type="text/javascript" src="https://s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
<title>Hardcoded Embedded Test</title>
</head>
<body>
	<script type="text/javascript">
	    HelloSign.init("<?php echo $client_id ?>");
	    HelloSign.open({
	        url: "<?php echo $sign_url ?>",
	//			        url: "' . $signature_url . '",
	        allowCancel: true,
	        uxVersion: 2, // yes this is default, but the iframe behaves better when explicit
                skipDomainVerification: true,
	        messageListener: function (eventData) {
                        (console.log(">-*>-*>-*> Got message data: " + JSON.stringify(eventData)));
                        if (eventData.event == HelloSign.EVENT_SIGNED) {
                            HelloSign.close();
                            console.log(eventData.signature_id) + "this is the signature_id";
                            window.location = "index.php"; //this is a great way to redirect after signing
                        } else if (eventData.event == HelloSign.EVENT_CANCELED) {
                            HelloSign.close();
                            alert("Event Canceled And Stuff!");
                            console.log(eventData);
                            // window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_ERROR) {
                            HelloSign.close();
                            alert("There Was An Error And Stuff!");
                            console.log(eventData);
                            // window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_SENT) { //used only if you're using embedded requesting
                            HelloSign.close();
                            alert("Signature Request Sent And Stuff!");
                            console.log(eventData);
                            console.log("************");
                            console.log(eventData.signature_request_id);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_TEMPLATE_CREATED) { //used only if you're using embedded template creation
                            HelloSign.close();
                            var template_id = eventData.template_id;
                            // window.alert("Template ID is " + template_id);
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_DECLINED) { //used only if you're allowing the signers to decline
                            HelloSign.close();
                            // alert("Signature Request declined And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        }
                    }
	    });
	</script>
</body>
</html>
