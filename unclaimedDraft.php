<!DOCTYPE html>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Unclaimed Draft Requesting</title>
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
        $target_file = $target_dir . basename($_FILES["unclaimedDraftFile"]["name"]);
        $uploadOk = 1; //this is used if the other if statements are used
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
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
            if (move_uploaded_file($_FILES["unclaimedDraftFile"]["tmp_name"], $target_file)) {
//                echo "The file " . basename($_FILES["unclaimedDraftFile"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file. <br />";
                $uploadOk = 0;
                goto skip;
            }
        }

        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key_1);

        $request = new HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->addFile("$target_file");
        $request->addSigner("radhack242@gmail.com", "Alex");
        $request->setFormFieldsPerDocument(
            array(//everything
                array(//document 1
                    array(//component 1
                        "api_id" => "things_1",
                        "name" => "Name Here",
                        "type" => "text",
                        "x" => 220,
                        "y" => 85,
                        "width" => 253,
                        "height" => 16,
                        "required" => true,
                        "signer" => 0
                    ),
                    array(//component 2
                        "api_id" => "things_2",
                        "name" => "Address Here",
                        "type" => "text",
                        "x" => 530,
                        "y" => 85,
                        "width" => 152,
                        "height" => 16,
                        "required" => true,
                        "signer" => 0
                    ),
                    array(//component 3
                        "api_id" => "lotsof_2",
                        "name" => "",
                        "type" => "signature",
                        "x" => 90,
                        "y" => 315,
                        "width" => 223,
                        "height" => 30,
                        "required" => true,
                        "signer" => 0,
                        "page" => 2,
                    ),
                ),
            )
        );

        $draft_request = new HelloSign\UnclaimedDraft($request);
        $draft_request->setType("request_signature");
        try {
        $response = $client->createUnclaimedDraft($draft_request);
        } catch (Exception $e) {
            print_r($e);
            echo("made it");
        }
        

        $signature_request_id = $response->signature_request_id;
        $createdHow = "unclaimedDraft";
        include('db.php');

        $sign_url = $draft_request->getClaimUrl();
        echo("<br /><a href=$sign_url>This</a> is your Claim URL<br />");

        ?>
        
    Click the button below to open up hellosign.com and claim this request. Otherwise, click <a href="index.php">here</a> to go home.<br />
        <button onclick="getDocuments();">Click to Claim!</button>
    <script>
        function getDocuments() {
            setTimeout(function(){window.location = "<?php echo $sign_url ?>,'_blank'";}, 1000);  
        }
    </script>
    
    <?php    
        skip:
        // skip loop so this doesn't run when skip isn't used
        if ($uploadOk == 0) {
            echo '<br />';
            echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
        }
        ?>
    </body>
</html>
