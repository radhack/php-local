<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Embedded Signing with Template</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="//s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
        <link rel="stylesheet" type="text/css" href="newcss.css" />
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
        <link rel="icon" type="image/png" href="/favicon-32x32.png"/>
        <link rel="icon" type="image/png" href="/favicon-16x16.png"/>
        <link rel="manifest" href="/manifest.json" />
        <link rel="mask-icon" href="/safari-pinned-tab.svg"/>
    </head>
    <body>
        <?php
        require_once 'vendor/autoload.php';
        include('auth.php');
        if (isset($_SESSION['signature_id'])) {
            try {
            $client = new HelloSign\Client($api_key);
            $embedded_response = $client->getEmbeddedSignUrl($_SESSION['signature_id']);
            $sign_url = $embedded_response->getSignUrl();
            include('signerpage.php');
            } catch (Exception $e) {
                if ($e->getMessage() == "This request has already been signed") {
                    $filename = "downloaded_files/".$_SESSION['signature_request_id'].".pdf";
                    $client = new HelloSign\Client($api_key);
                    $file = $client->getFiles($_SESSION['signature_request_id'], $filename , HelloSign\SignatureRequest::FILE_TYPE_PDF);
                    echo "<iframe src=\"$filename\" width=\"100%\" style=\"height:880px\"></iframe>";
                } else {
                    echo "there was a different value";
                }
            }
        } else {

        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key);
        // Example call with logging for embedded requests
        $request = new HelloSign\TemplateSignatureRequest;
        $request->enableTestMode();
        $request->setTitle("Testing");
        $request->setSubject('Embedded Signing With Template');
        $request->setMessage('Awesome, right?');
        $request->setSigner('Role1', 'jack@example.com', 'Johnny Mc.Dotty and Mc-Dashy');
//        $request->setSigner('Role2', 'jack@example.com', 'and Jill');
//        $request->setSigner('Role3', 'jack@example.com', 'Went');
//        $request->setSigner('Role4', 'jack@example.com', 'Up The');
//        $request->setSigner('Role5', 'jack@example.com', 'Hill');
        $request->setCustomFieldValue('Cost', "$100,000,000 and all of the things that go along with things like this are too much for lorem ipsum to handle and all that it represents and all that accounts for all the things in Maui and Thailand.");
        $request->setCustomFieldValue('Amount', "There's not much", "Role1");
        $request->setCustomFieldValue("Applicant", "Bobs's the name", "Role1");
//        $request->setCustomFieldValue('Test Merge', '$100,000,000');
//        $request->setCustomFieldValue('Test Merge 1', "There's not much here because of lorum ipsum and all that it represents and all that accounts for all the things in Maui and Thailand, which are all mostly connected through wormholes and zombies.");
//        $request->setCustomFieldValue("Test Merge 3", "Bobs's the name");
//        $request->setCustomFieldValue("Test Merge 2", true);
        $request->setTemplateId('5eafe0c773034d3d1e5dffda2580ae3b46014b44');

        // Turn it into an embedded request
        $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

        // Send it to HelloSign
        $response = $client->createEmbeddedSignatureRequest($embedded_request);

        // wait for callback with signature_request_sent
        // TODO write that in here at some point
        // Grab the signature ID for the signature page that will be embedded in the page
        $signature_request_id = $response->signature_request_id;
        $_SESSION['signature_request_id'] = $signature_request_id;
        $signatures = $response->getSignatures();
        $signature_id = $signatures[0]->getId();
        $_SESSION['signature_id'] = $signature_id;
        $createdHow = "signatureRequestWithTemplate";
        
        $event_sent_bool = 0; // set the db to false for signature_request_sent event
        include('db.php');

        // Retrieve the URL to sign the document
        $embedded_response = $client->getEmbeddedSignUrl($signature_id);

        // Store it to use with the embedded.js HelloSign.open() call
        $sign_url = $embedded_response->getSignUrl();
//        $sign_url = str_replace("/", "\/", $embedded_response->getSignUrl());
//        echo ("<br />$sign_url");


        // call the html page with the embedded.js lib and HelloSign.open()
        include('signerpage.php');
        }
        ?>

    </body>
</html>

