<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Embedded Requesting for Embedded Signing</title>
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

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["requestingFileEmbSig"]["name"]);
        $uploadOk = 1; //this is used if the other if statements are used
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, xlsx, txt, html, gif
        if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "ppsx" && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "tif" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt" && $imageFileType != "html" && $imageFileType != "gif") {
            echo "Sorry, only doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, <br />"
            . "xlsx, txt, html, and gif are allowed at this point <br />";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            goto skip;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["requestingFileEmbSig"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["requestingFileEmbSig"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file. <br />";
                $uploadOk = 0;
                goto skip;
            }
        }

        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key);

        $request = new HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->setRequesterEmail('phpexample@example.com');
        //$request->setHideTextTags(true);
        //$request->setUseTextTags(true);
        $request->addFile("$target_file");
        $draft_request = new HelloSign\UnclaimedDraft($request, $client_id);
        $draft_request->setIsForEmbeddedSigning(true);
        $response = $client->createUnclaimedDraft($draft_request);
        $sign_url = $draft_request->getClaimUrl();


//        $baseReq = new HelloSign\TemplateSignatureRequest();
//        $baseReq->setTemplateId("5f5650f1cbfd497393cfa426d7d8d81e2a62a1f4");
//        $baseReq->setSigner('Role1', 'radhack242@gmail.com', 'Jack');
////        $request->setSigner('Role2', 'jack@example.com', 'and Jill');
////        $request->setSigner('Role3', 'jack@example.com', 'Went');
////        $request->setSigner('Role4', 'jack@example.com', 'Up The');
////        $request->setSigner('Role5', 'jack@example.com', 'Hill');
////        $request->setCustomFieldValue('Cost', '$100,000,000                                             ', "Role1");
////        $request->setCustomFieldValue('Amount', "There's not much", "Role1");
////        $request->setCustomFieldValue("Applicant", "Bobs's the name", "Role1");
//        $baseReq->setCustomFieldValue('Cost', '$100,000,000');
//        $baseReq->setCustomFieldValue('Amount', "There's not much");
//        $baseReq->setCustomFieldValue("Applicant", "Bobs's the name");
//        $baseReq->setRequesterEmailAddress('alex@hellosign.com');
//        $baseReq->addMetadata('custom_id', '1234');
//        $baseReq->enableTestMode(); //this is a documentation bug at the very least
//
//        $request = new HelloSign\EmbeddedSignatureRequest($baseReq);
//        $request->setClientId($client_id);
//        $request->setClientId($_SESSION['client_id']);
//        $request->isUsingTemplate(true);
//        $request->setEmbeddedSigning();
//                $sign_url = $response->getClaimUrl();

//        $response = $client->createUnclaimedDraftEmbeddedWithTemplate($request);
        $signature_request_id = $response->signature_request_id;
        $createdHow = "embeddedRequestingWithEmbeddedSigning";
        include('db.php');

        // call the html page with the embedded.js lib and HelloSign.open()
        include('signerpage.php');

        $signature_request_object = $client->getSignatureRequest($signature_request_id);
        include('db.php');

        skip:
        // skip loop so this doesn't run when skip isn't used
        if ($uploadOk == 0) {
            echo '<br />';
            echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
        }
        ?>
    </body>
</html>
