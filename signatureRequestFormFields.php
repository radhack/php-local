<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Form Fields Signature Request</title>
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
            try {// Instance of a client for you to use for calls
                $client = new HelloSign\Client($api_key);
                // Retrieve the URL to sign the document
                $embedded_response = $client->getEmbeddedSignUrl($_SESSION['sign_id']);

                // Store it to use with the embedded.js HelloSign.open() call
                $sign_url = $embedded_response->getSignUrl();
                include('signerpage.php');
            } catch (Exception $e) {
                echo "$e is the error - you'll have to go <a href=\"index.php\">here</a> to get home and try again";
            }
        } else {
            // Instance of a client for you to use for calls
            $client = new HelloSign\Client($api_key);
            // Example call with logging for embedded requests
            $request = new HelloSign\SignatureRequest;
            $request->enableTestMode();
            $request->setTitle("Testing Form Fields Per Document - Prod");
            $request->setSubject('Embedded Signature Request with Form Fields');
            $request->setMessage('Awesome, right?');
            $request->addSigner('testing@testing.com', 'Signer Person, IV');
//            $request->addCC("alex+1@hellosign.com");
//            $request->addCC("alex+2@hellosign.com");
//            $request->addCC("alex+3@hellosign.com");
//            $request->addCC("alex+4@hellosign.com");
//            $request->addCC("alex+5@hellosign.com");
//            $request->addCC("alex+6@hellosign.com");
//            $request->addCC("alex+7@hellosign.com");
//            $request->addCC("alex+8@hellosign.com");
//            $request->addCC("alex+9@hellosign.com");
//            $request->addCC("alex+10@hellosign.com");
//            $request->addCC("alex+11@hellosign.com");
//            $request->addCC("alex+12@hellosign.com");
//            $request->addCC("alex+13@hellosign.com");
//            $request->addCC("alex+14@hellosign.com");
//            $request->addCC("alex+15@hellosign.com");
//            $request->addCC("alex+16@hellosign.com");
//            $request->addCC("alex+17@hellosign.com");
//            $request->addCC("alex+18@hellosign.com");
//            $request->addCC("alex+19@hellosign.com");
//            $request->addCC("alex+20@hellosign.com");
//            $request->addCC("alex+21@hellosign.com");
//            $request->addCC("alex+22@hellosign.com");
//            $request->addCC("alex+23@hellosign.com");
//            $request->addCC("alex+24@hellosign.com");
            $request->enableAllowDecline();
            $request->setFormFieldsPerDocument(
//                array(//everything
//                    array(//document 1
//                        array(//component 1
//                            "api_id" => "things_1",
//                            "name" => "Name Here",
//                            "type" => "text",
//                            "x" => 220,
//                            "y" => 85,
//                            "width" => 253,
//                            "height" => 16,
//                            "required" => true,
//                            "signer" => 0
//                        ),
//                        array(//component 2
//                            "api_id" => "things_2",
//                            "name" => "Address Here",
//                            "type" => "text",
//                            "x" => 530,
//                            "y" => 85,
//                            "width" => 152,
//                            "height" => 16,
//                            "required" => true,
//                            "signer" => 0
//                        ),
//                        array(//component 3
//                            "api_id" => "lotsof_2",
//                            "name" => "",
//                            "type" => "signature",
//                            "x" => 90,
//                            "y" => 315,
//                            "width" => 223,
//                            "height" => 30,
//                            "required" => true,
//                            "signer" => 0,
//                            "page" => 2,
//                        ),
//                    ),
//                )
                [//everything
                    [//document 1
                        [//component 1
                            "api_id" => "checkbox0",
                            "name" => "Check Box 1",
                            "type" => "checkbox",
                            "x" => 220,
                            "y" => 85,
                            "width" => 10,
                            "height" => 16,
                            "required" => FALSE,
                            "signer" => 0
                        ],
                        [//component 2
                            "api_id" => "signature0",
                            "name" => "Signature 1",
                            "type" => "signature",
                            "x" => 530,
                            "y" => 85,
                            "width" => 152,
                            "height" => 16,
                            "required" => FALSE,
                            "signer" => 0
                        ],
                        [//component 3
                            "api_id" => "signature1",
                            "name" => "Signature 2",
                            "type" => "signature",
                            "x" => 90,
                            "y" => 315,
                            "width" => 223,
                            "height" => 30,
                            "required" => true,
                            "signer" => 0,
                            "page" => 2,
                        ]
                    ]
                ]
            );
            $request->addFileUrl("http://www.startupprofessionals.com/linked/non-disclosure-agreement-mutual-generic-blank.pdf");

            // Turn it into an embedded request
            $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

            // Send it to HelloSign
            $response = $client->createEmbeddedSignatureRequest($embedded_request);

            // wait for callback with signature_request_sent
            // 
            // Grab the signature ID for the signature page that will be embedded in the page
            $signature_request_id = $response->signature_request_id;
            $signatures = $response->getSignatures();
            $signature_id = $signatures[0]->getId();
            $_SESSION['signature_id'] = $signature_id;

            // Retrieve the URL to sign the document
            $embedded_response = $client->getEmbeddedSignUrl($signature_id);

            // Store it to use with the embedded.js HelloSign.open() call
            $sign_url = $embedded_response->getSignUrl();
        }

        // call the html page with the embedded.js lib and HelloSign.open()
        include('signerpage.php');
        ?>
    </body>
</html>
