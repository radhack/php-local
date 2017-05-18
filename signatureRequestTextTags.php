<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Text Tags Signature Request</title>
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
        // when I'm ready to start handling checkboxes on the form:
        // http://www.html-form-guide.com/php-form/php-form-checkbox.html
        require_once 'vendor/autoload.php';
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploadedTextTags"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if ($imageFileType != "pdf" && $imageFileType != "docx") {
            echo "Sorry, only pdfs and docxs are allowed at this point";
            echo '<br />';
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            echo '<br />';
            // $uploadOk = 0;
            goto skip;

            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadedTextTags"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["uploadedTextTags"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                $uploadOk = 0;
                goto skip;
            }
        }
        // Get your credentials from environment variables
        $api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';
        $client_id = getenv('HS_CLIENT_ID_LOCAL') ? getenv('HS_CLIENT_ID_LOCAL') : '';

        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key);
        // Example call with logging for embedded requests
        $request = new HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->setUseTextTags(TRUE);
        $request->setTitle("Testing");
        $request->setSubject('My First embedded signature request');
        $request->setMessage('Awesome, right?');
        $request->addSigner('testing@testing.com', 'Something');
//        $request->addSigner("testingmore@testing.com", "Something Else");
        $request->addFile("$target_file");

        // Turn it into an embedded request
        $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

        // Send it to HelloSign
        $response = $client->createEmbeddedSignatureRequest($embedded_request);

        // wait for callback with signature_request_sent
        // 
        // Grab the signature ID for the signature page that will be embedded in the page
        $signatures = $response->getSignatures();
        $signature_id = $signatures[0]->getId();

        // Retrieve the URL to sign the document
        $embedded_response = $client->getEmbeddedSignUrl($signature_id);

        // Store it to use with the embedded.js HelloSign.open() call
        $sign_url = $embedded_response->getSignUrl();

        // call the html page with the embedded.js lib and HelloSign.open()
        include('signerpage.php');

        skip:
        if ($uploadOk == 0) {
            echo '<br />';
            echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
        }
        ?>
    </body>
</html>
