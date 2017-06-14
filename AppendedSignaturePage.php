<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Appended Signature Page</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="//s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
        <link rel="stylesheet" type="text/css" href="newcss.css" />
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
        <link rel="icon" type="image/png" href="/favicon-32x32.png"/>
        <link rel="icon" type="image/png" href="/favicon-16x16.png"/>
        <link rel="manifest" href="/manifest.json" />
        <link rel="mask-icon" href="/safari-pinned-tab.svg"/>
        <style> 
            #myImg {
                border-radius: 5px;
                cursor: pointer;
                transition: 0.3s;
            }

            #myImg:hover {opacity: 0.7;}

            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
            }
            /* Modal Content (image) */
            .modal-content {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
            }

            /* Caption of Modal Image */
            #caption {
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #ccc;
                padding: 10px 0;
                height: 150px;
            }

            /* Add Animation */
            .modal-content, #caption {    
                -webkit-animation-name: zoom;
                -webkit-animation-duration: 0.6s;
                animation-name: zoom;
                animation-duration: 0.6s;
            }

            @-webkit-keyframes zoom {
                from {-webkit-transform:scale(0)} 
                to {-webkit-transform:scale(1)}
            }

            @keyframes zoom {
                from {transform:scale(0)} 
                to {transform:scale(1)}
            }
            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
                .modal-content {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        Hi there - thanks for visiting my page
        <?php
        require_once 'vendor/autoload.php';
        include('auth.php');

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploadedfile"]["name"]);
        $uploadOk = 1; //this is used if the other if statements are used
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        //if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "ppsx" && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "tif" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt" && $imageFileType != "html" && $imageFileType != "gif") {
        //    echo "Sorry, only doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, <br />"
        //    . "xlsx, txt, html, and gif are allowed at this point <br />";
        //    $uploadOk = 0;
        //}
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            goto skip;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["uploadedfile"]["name"]) . " has been uploaded. <br />";
            } else {
                echo "Sorry, there was an error uploading your file. <br />";
                $uploadOk = 0;
                goto skip;
            }
        }

        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key);

        // Example call with logging for embedded requests
        $request = new HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->setTitle("Testing");
        $request->setSubject('My First embedded signature request');
        $request->setMessage('Awesome, right?');
//        $request->addSigner($_POST['signeremail'], $_POST['signername']);
        $request->addSigner("radhack242+signersandthings@gmail.com", "Bob The Signer");
        // $request->setAllowDecline(true); // uncomment this when allowDecline is built into the PHP SDK
        $request->addFile("$target_file");

        rename($target_file, "$target_file.embSigReq");
        // Turn it into an embedded request
        $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

        // Send it to HelloSign
        $response = $client->createEmbeddedSignatureRequest($embedded_request);

        // Grab the signature ID for the signature page that will be embedded in the page
        $signature_request_id = $response->signature_request_id;
        $signatures = $response->getSignatures();
        $signature_id = $signatures[0]->getId();
        $createdHow = "appendedSignaturePage";
        $event_sent_bool = 0; // this is used to setup responsive design, where I wait for the signature_request_sent callback event before bringing up the iframe
        include('db.php');
        ?>
        <script>
            console.log("WHAT THE FUCK YO");
            setTimeout(function () { alert('Loading - please wait');
            }, 3000);
        </script>
        <?php
        // Retrieve the URL to sign the document
        $response = $client->getEmbeddedSignUrl($signature_id);

        // Store it to use with the embedded.js HelloSign.open() call
        $sign_url = $response->getSignUrl();

        // check for the callback
        // Create connection
        $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //TODO move this to signerpage so that loading gif will load
        while (1 == 1){
        $result = mysqli_query($conn, "SELECT event_sent_bool FROM signatureId WHERE signature_id = '$signature_id'");
        $sent_event_received = mysqli_fetch_row($result);

        echo "<br /><br />$sent_event_received[0]";

            if ($sent_event_received[0] == 1) {
                break;
            } else {
                ?>
                <script>
                    console.log("still loading...");
                    setTimeout(function () {
                    }, 5000);
                </script>
                <?php
            }
        }
        include('signerpage.php');
$conn->close();

skip:
// skip loop so this doesn't run when skip isn't used
if ($uploadOk === 0) {
    echo '<br />';
    echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
}
?>
    </body>
</html>
