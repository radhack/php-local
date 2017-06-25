<!DOCTYPE html>
<head>
    <title>Callback Handler</title>
    <link rel="stylesheet" type="text/css" href="newcss.css" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" href="/favicon-32x32.png"/>
    <link rel="icon" type="image/png" href="/favicon-16x16.png"/>
    <link rel="manifest" href="/manifest.json" />
    <link rel="mask-icon" href="/safari-pinned-tab.svg"/>
</head>
<body>
    <!--if people find their way here, give them a way to get back home-->
    <p>WARNING: YOU ARE IN DANGER OF BEING BORED<br /></p>
    <p>PROCEED TO THE <a href="index.php">HOMEPAGE</a> TO AVOID BOREDOM</p>
    <?php
    require_once 'vendor/autoload.php';
    include('auth.php');

    if (isset($_SERVER['HTTP_X_HELLOWORKS_SIGNATURE'])) {
        $json = GuzzleHttp\json_decode(file_get_contents('php://input'));
        $status = $json->status;
        $identity = $json->identity;
        $hw_id = $json->id;
        $form1_name = $json->forms[0]->name;
        $form1_url = $json->forms[0]->document->url;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.helloworks.com/v2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer pkiOk3IGxleaDH7rVwRznvyZYAkteP2p",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $parsed = json_decode($response);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            echo $parsed->object->value;
            echo "<br />";
        }

        $bearer = $parsed->object->value;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$form1_url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "identity%5Btype%5D=email&identity%5Bvalue%5D=radhack242%40gmail.com&identity%5Bfull_name%5D=Alex%20Griffen&settings%5Bcallback_url%5D=https%3A%2F%2F9060677a.ngrok.io%2Fcallback.php&identity%5Bverification%5D=link&merge_fields%5B0%5D%5Bcity%5D=San%20Francisco",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $bearer",
                "cache-control: no-cache"
            ),
        ));

        $response_pdf = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

        $target_file = "$hw_id.pdf";
        file_put_contents("downloaded_files/" . $target_file, $response_pdf);
        $file_encoded = base64_encode($response_pdf);
        $to = new SendGrid\Email("HelloWorks Signer", "radhack242@gmail.com");
        $from = new SendGrid\Email("HelloWorks Platform", "radhack242@gmail.com");
        $subject = "HelloWorks callback received";
        $content = new SendGrid\Content("text/html", "<pre>$status</pre> is the status<br /><br />$identity is the email of the signer<br /><pre>$hw_id</pre> is the instance id<br /><pre>$form1_name</pre> is the form name<br /><br /><a href=\"$form1_url\">this</a> is where you can download the form");
        $attachment = new SendGrid\Attachment();
        $attachment->setType("application/pdf");
        $attachment->setDisposition("attachment");
        $attachment->setFilename($target_file);
        $attachment->setContent($file_encoded);
        $email = new SendGrid\Mail($from, $subject, $to, $content);
        $email->addAttachment($attachment);

        $sg = new \SendGrid($sendgrid_api_key);
        $response = $sg->client->mail()->send()->post($email);

        echo $response->statusCode();
        print_r($response->headers());
        echo $response->body();

// print everything out
        print_r($response);
        $hash_check_failed = 0;
        goto invalid_hash;
    }

    $data = json_decode($_POST['json']);


    if ($data != null) { //only send the response if I'm hit with a POST
        echo 'Hello API Event Received';
    } else {
        goto invalid_hash;
    }

    //remove the below comment to test callback actions
//    goto invalid_hash;

    $event_time = $data->event->event_time;
    $event_type = $data->event->event_type;
    $event_hash = $data->event->event_hash;
    $hash_check_failed = 0;

    //check for hash validity
    $hash_check = hash_hmac("sha256", $event_time . $event_type, $api_key);
//    echo ("*****HASH CHECK<br />$hash_check<br />");

    $callback_event = new HelloSign\Event($data);
    print_r($callback_event);
    if ($callback_event->isValid($api_key) == FALSE) {
        $hash_check_failed = 1;
        goto invalid_hash;
    }

    // check header for MD5 hash
//    $header_md5 = get_headers('Content-MD5');
//    print "$header_md5";
//    file_put_contents("callback.json",$data);
//    $json_str = $data->json;
//    $md5_check = base64_encode(hash_hmac("md5", $json_str, $api_key));
//    if ($header_md5 != $md5_check) {
//        $hash_check_failed = 2;
//        goto invalid_hash;
//    }
    $reported_app = $data->event->event_metadata->reported_for_app_id;

    // The signature_request_all_signed event is called whenever the signature
    // request is completely signed by all signees, HelloSign has processed
    // the document and has it available for download.
    // if ($reported_app === 'afedad951b68dc42bfbd930e81d97175') {
    if ($reported_app === '3e3f283135002d1993a92124341193df') {
//    if ($reported_app === 'xxx') { //stop processing callbacks for now
        if ($event_type === 'signature_request_all_signed') {
            $client = new HelloSign\Client($api_key);
            $signature_request_id = $data->signature_request->signature_request_id;
            $requester = $data->siganture_request->requester_email_address;
            $signer_email = $data->signature_request->sigantures->signer_email_address;
            $signer_name = $data->signature_request->sigantures->signer_name;

            // Here you define where the file should download to. This should be
            // customized to your app's needs.
            $get_file = $client->getFiles($signature_request_id, "downloaded_files/" . $signature_request_id . ".pdf", HelloSign\SignatureRequest::FILE_TYPE_PDF);

            // also trigger an email 
            // right now I'm just hardcoding the receipient in the signature request,
            // but this could be updated to work with a database
            // to make the receipient smart
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "$signer_email",
                'toname' => "$signer_name",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'bcc' => "$requester",
                'bccname' => "Signature Request All Signed",
                'subject' => "$event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br /><br />",
                "files[$signature_request_id.pdf]" => file_get_contents("downloaded_files/$signature_request_id.pdf"),
                    // here's where I got some of the information for attaching files: https://sendgrid.com/docs/API_Reference/Web_API/mail.html
                    // had to figure out the file_get_contents on my own
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        } elseif ($event_type === 'callback_test') {
            $event_time = $data->event->event_time;
            $event_meta = $data->event->event_metadata->reported_for_account_id;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Callback Test",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "$event_type received",
                'text' => "$event_type was received at $event_time",
                'html' => "<strong>I'm HTML!</strong><br />"
                . "And I like pudding!<br />"
                . "$event_type was received at $event_time"
                . "$event_meta is the reported_for_account",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        } elseif ($event_type === 'signature_request_sent') {           
            $signature_request_id = $data->signature_request->signature_request_id;
            $dbadmin = getenv('DB_ADMIN');
            $dbpassword = getenv('DB_PASSWORD');
            $servername = "localhost";
            $dbname = "testdb";
            // Create connection
            $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE signatureId SET event_sent_bool='1' WHERE signature_request_id='$signature_request_id'";

//            if ($conn->query($sql) === TRUE) {
            if ($conn->query($sql) == "DERP") {
                $event_time = $data->event->event_time;
                $sendgrid = new SendGrid($sendgrid_api_key);
                $url = 'https://api.sendgrid.com/';
                $pass = $sendgrid_api_key;

                $params = array(
                    'to' => "radhack242+$event_type@gmail.com",
                    'toname' => "Signature Request Sent",
                    'from' => "radhack242@gmail.com",
                    'fromname' => "Simple PHP",
                    'subject' => "$event_type received",
                    'html' => "<strong>$signature_request_id</strong> has been updated and <br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
                );

                $request = $url . 'api/mail.send.json';

// Generate curl request
                $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
                curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
                curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
                curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
                curl_setopt($session, CURLOPT_HEADER, false);
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
                $response = curl_exec($session);
                curl_close($session);

// print everything out
                print_r($response);
            } else {

                $event_time = $data->event->event_time;
                $sendgrid = new SendGrid($sendgrid_api_key);
                $url = 'https://api.sendgrid.com/';
                $pass = $sendgrid_api_key;

                $params = array(
                    'to' => "radhack242+$event_type@gmail.com",
                    'toname' => "Signature Request Sent",
                    'from' => "radhack242@gmail.com",
                    'fromname' => "Simple PHP",
                    'subject' => "$event_type received",
                    'html' => "<strong>$signature_request_id</strong> Error INSERTing (lol): $conn->error <br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
                );

                $request = $url . 'api/mail.send.json';

// Generate curl request
                $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
                curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
                curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
                curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
                curl_setopt($session, CURLOPT_HEADER, false);
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
                $response = curl_exec($session);
                curl_close($session);

// print everything out
                print_r($response);
            }
            $conn->close();
        } elseif ($event_type === 'file_error') {
            $signature_request_id = $data->signature_request->signature_request_id;
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "File Error",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "$event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        } elseif ($event_type === 'unknown_error') {
            $signature_request_id = $data->signature_request->signature_request_id;
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Unknown Error",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "$event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        } elseif ($event_type === 'signature_request_email_bounce') {
            $signature_request_id = $data->signature_request->signature_request_id;
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Signature Request Email Bounced",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "$event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        } elseif ($event_type === 'signature_request_declined') {
            $signature_request_id = $data->signature_request->signature_request_id;
//TODO - figure out how to put this in a loop that looks for
//"status_code": "declined", then reports the
//signature_id of that signer
//the Name
//and the "decline_reason"
//right now this is looking only at the responses
//of the first signer - signer[0]
//and that person may not be someone who declined
            $signer_params = $data->signature_request->signatures[0];
            $signature_id = $signer_params->signature_id;
            $declined_name = $signer_params->signer_name;
            $declined_reason = $signer_params->decline_reason;

            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Signature Request Declined",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "$event_type received",
                'html' => "<strong>$signature_request_id</strong><br />"
                . "Is the signature_request_id<br />"
                . "$event_type was received at $event_time<br />"
                . "$signature_id is the signature_id<br />"
                . "$declined_name is their name<br />"
                . "$declined_reason is their reason for declining",
            );


            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
            //}
            // unset($signer_data);
        } else {
            $signature_request_id = $data->signature_request->signature_request_id;
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_api_key);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_api_key;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Event Not Setup",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "$event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        }
    }
    invalid_hash:
    if ($hash_check_failed == 1) {

        $dbadmin = getenv('DB_ADMIN');
        $dbpassword = getenv('DB_PASSWORD');
        $servername = "localhost";
        $dbname = "testdb";
        $server_time = time();
        $json_data = $_POST['json'];
        $data_encoded = json_encode($data);
        $data_serialized = serialize($data);
        
        $sendgrid = new SendGrid($sendgrid_api_key);
        $url = 'https://api.sendgrid.com/';
        $pass = $sendgrid_api_key;


        // Create connection to save to sigantureRequest table
        $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $escaped_data = mysqli_real_escape_string($conn, $json_data);
//        print_r($escaped_data . "<br />*&^ *&^");

        $sql = "INSERT INTO callback (event_time, event_type, event_hash, hash_check, server_time, data) VALUES('$event_time', "
                . "'$event_type', "
                . "'$event_hash', "
                . "'$hash_check', "
                . "'$server_time', "
                . "'$escaped_data')";
//        $sql = $conn-> real_escape_string($sql);

        if ($conn->query($sql) === TRUE) {
            echo "INSERT INTO callback testdb successfull";
            $params = array(
                'to' => "radhack242@gmail.com",
                'toname' => "Hash Failed Recorded",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Hash Check Failed and Recorded",
                'html' => "$hash_check is the value from my calculation, but $event_hash is hash in the object.<br />$event_time is the event time, and<br />$event_type is the event type.",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
// Tell curl to use HTTP POST
            curl_setopt($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
            curl_setopt($session, CURLOPT_HEADER, false);
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
            $response = curl_exec($session);
            curl_close($session);

// print everything out
            print_r($response);
        } else {
//            $error = "<br />Error INSERTing (lol): " . $conn->error;
            echo "<br />Error INSERTing (lol): " . $conn->error;
//            $params = array(
//                'to' => "radhack242@gmail.com",
//                'toname' => "Hash Failed NOT Recorded",
//                'from' => "radhack242@gmail.com",
//                'fromname' => "Simple PHP",
//                'subject' => "Hash Check Failed NOT recorded",
//                'html' => "$error is the sql error, and $hash_check is the value from my calculation, but $event_hash is hash in the object.<br />$event_time is the event time, and<br />$event_type is the event type.",
//            );
//
//            $request = $url . 'api/mail.send.json';
//
//// Generate curl request
//            $session = curl_init($request);
//// Tell PHP not to use SSLv3 (instead opting for TLS)
//            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
//            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
//// Tell curl to use HTTP POST
//            curl_setopt($session, CURLOPT_POST, true);
//// Tell curl that this is the body of the POST
//            curl_setopt($session, CURLOPT_POSTFIELDS, $params);
//// Tell curl not to return headers, but do return the response
//            curl_setopt($session, CURLOPT_HEADER, false);
//            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//
//// obtain response
//            $response = curl_exec($session);
//            curl_close($session);
//
//// print everything out
//            print_r($response);
        }
        $conn->close();
    }
    ?>
</body>
</html>