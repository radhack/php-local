<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Review Document and Sign</title>
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

        // Get your credentials from environment variables
        $api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';
        $client_id = getenv('HS_CLIENT_ID_LOCAL') ? getenv('HS_CLIENT_ID_LOCAL') : '';

        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key);
        
        $signature_id = $_GET['signature_id'];
        if ($signature_id == null) {
            echo 'something went wrong <br />';
            echo '<a href = "localhost:8899">Click here</a> to go home';
        }
        
        // Retrieve the URL to sign the document
        $response = $client->getEmbeddedSignUrl($signature_id);

        // Store it to use with the embedded.js HelloSign.open() call
        $sign_url = $response->getSignUrl();

        include('signerpage.php');

        ?>
    </body>
</html>