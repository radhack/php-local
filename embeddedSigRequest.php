<?php
require_once ('vendor/autoload.php'); //if you’re using Composer, or
require_once ('./vendor/hellosign/hellosign-php-sdk/HelloSign.php'); //if not using Composer and assuming the SDK is installed in the 'vendor' folder
include("auth.php");
$client = new HelloSign\Client($api_key);
$request = new HelloSign\SignatureRequest;
$request->enableTestMode();
$request->setSubject('My First embedded signature request with a template');
$request->setMessage('Awesome, right?');
$request->addSigner('jack@example.com', 'Jack');
$request->addSigner('jill@example.com', 'Jill');
$request->addFile("./nda.pdf"); //assuming there’s a simple test file in the root of the application

// $client_id = 'YOUR_CLIENT_ID';
$embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);
$response = $client->createEmbeddedSignatureRequest($embedded_request);
$signatures = $response->getSignatures(); //this method gets the signatures object in the response
$signature_id = $signatures[0]->getId(); //this method get the signature_id of the first signer in the signatures object
// Retrieve the URL to sign the document
$response = $client->getEmbeddedSignUrl($signature_id);

// Store it to use with the embedded.js HelloSign.open() call
$sign_url = $response->getSignUrl();

?>
<!DOCTYPE html>
<html>
<head>
        <title>Embedded Signing Hardcoded</title>
        <script type="text/javascript" src="//s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
</head>
<body>
<script>
HelloSign.init("<?php echo $client_id ?>");
HelloSign.open({
    url: "<?php echo $sign_url ?>",
    allowCancel: true,
    skipDomainVerification: true,
    uxVersion: 2,
    messageListener: function (eventData) {
        (console.log(">-*>-*>-*> Got message data: " + JSON.stringify(eventData)));

        if (eventData.event == HelloSign.EVENT_SIGNED) {
            HelloSign.close();
            console.log(eventData.signature_id) + "this is the signature_id";
        } else if (eventData.event == HelloSign.EVENT_CANCELED) {
            HelloSign.close();
            console.log(eventData);
        } else if (eventData.event == HelloSign.EVENT_ERROR) {
            HelloSign.close();
            alert("There Was An Error And Stuff!");
            console.log(eventData);
        } else if (eventData.event == HelloSign.EVENT_SENT) {
            HelloSign.close();
            console.log(eventData);
            console.log(eventData.signature_request_id);
        } else if (eventData.event == HelloSign.EVENT_TEMPLATE_CREATED) {
            HelloSign.close();
            console.log(eventData);
        } else if (eventData.event == HelloSign.EVENT_DECLINED) {
            HelloSign.close();
            console.log(eventData);
        }
    }
});
</script>

</body>
</html>
