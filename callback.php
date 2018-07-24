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


    // ******************
    // HelloWorks section
    // ******************
    if (isset($_SERVER['HTTP_X_HELLOWORKS_SIGNATURE'])) {
        echo"HelloWorks started";
        $json = json_decode(file_get_contents('php://input'));
        $json_pretty = json_encode($json, JSON_PRETTY_PRINT);
        $raw_json_for_sendgrid = file_get_contents('php://input');
        $status = $json->status; // works in v3
        $workflow_id = $json->workflow_id; // for v3 only
        $hw_id = $json->id;
        $form_name = "signer_step.Form-nRJ3Vpnhm7";

        // GET the JWT
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.helloworks.com/v3/token/KSTV1feBmhOc5fSm", // Ram's v3 demo account
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer hIt7SweEw46TR8iDQZgYjZcTBC8NF4qjKi4y3pKq", // Ram's v3 demo account
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        // print_r($response);
        $err = curl_error($curl);
        curl_close($curl);

        $parsed = json_decode($response);
        // print_r($parsed);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            echo $parsed->object->value;
            echo "<br />";
        }

        // $bearer = $parsed->object->value;
        $bearer = $parsed->data->token;
        // echo("$bearer is the Bearer value");
//        form0 section, or v3 document section
        $curl0url = "https://api.helloworks.com/v3/workflow_instances/" . "$hw_id" . "/documents/" . "$form_name";  // v3
        print_r($curl0url);
        $curl0 = curl_init();
        curl_setopt_array($curl0, array(
            // CURLOPT_URL => "$form0_url", // v2
            CURLOPT_URL => "$curl0url", // v3
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $bearer",
                "cache-control: no-cache"
            ),
        ));

        $response_pdf0 = curl_exec($curl0);
        $err = curl_error($curl0);

        curl_close($curl0);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response_pdf0;
        }

//        form1 section, or v3 Audit Trail section
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            // CURLOPT_URL => "$form1_url", // v2
            CURLOPT_URL => "https://api.helloworks.com/v3/workflow_instances/" . "$hw_id" . "/audit_trail", // v3 audit trail
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $bearer",
                "cache-control: no-cache"
            ),
        ));

        $response_pdf1 = curl_exec($curl1);
        $err = curl_error($curl1);

        curl_close($curl1);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response_pdf1;
        }

//    //        form2 section
//    $curl2 = curl_init();
//
//    curl_setopt_array($curl2, array(
//        CURLOPT_URL => "$form2_url",
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => "",
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 30,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => "GET",
//        CURLOPT_HTTPHEADER => array(
//            "authorization: Bearer $bearer",
//            "cache-control: no-cache"
//        ),
//    ));
//
//    $response_pdf2 = curl_exec($curl2);
//    $err = curl_error($curl2);
//
//    curl_close($curl2);
//
//    if ($err) {
//        echo "cURL Error #:" . $err;
//    } else {
//        echo $response_pdf2;
//    }
//
//    //        form3 section
//    $curl3 = curl_init();
//
//    curl_setopt_array($curl3, array(
//        CURLOPT_URL => "$form3_url",
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => "",
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 30,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => "GET",
//        CURLOPT_HTTPHEADER => array(
//            "authorization: Bearer $bearer",
//            "cache-control: no-cache"
//        ),
//    ));
//
//    $response_pdf3 = curl_exec($curl3);
//    $err = curl_error($curl3);
//
//    curl_close($curl3);
//
//    if ($err) {
//        echo "cURL Error #:" . $err;
//    } else {
//        echo $response_pdf3;
//    }
//
//    //        form4 section
//    $curl4 = curl_init();
//
//    curl_setopt_array($curl4, array(
//        CURLOPT_URL => "$form4_url",
//        CURLOPT_RETURNTRANSFER => true,
//        CURLOPT_ENCODING => "",
//        CURLOPT_MAXREDIRS => 10,
//        CURLOPT_TIMEOUT => 30,
//        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//        CURLOPT_CUSTOMREQUEST => "GET",
//        CURLOPT_HTTPHEADER => array(
//            "authorization: Bearer $bearer",
//            "cache-control: no-cache"
//        ),
//    ));
//
//    $response_pdf4 = curl_exec($curl4);
//    $err = curl_error($curl4);
//
//    curl_close($curl4);
//
//    if ($err) {
//        echo "cURL Error #:" . $err;
//    } else {
//        echo $response_pdf4;
//    }

        $target_file0 = "$hw_id 0.pdf";
        file_put_contents("downloaded_files/" . $target_file0, $response_pdf0);
        $target_file1 = "$hw_id 1.pdf";
        file_put_contents("downloaded_files/" . $target_file1, $response_pdf1);
//    $target_file2 = "$hw_id 2.pdf";
//    file_put_contents("downloaded_files/" . $target_file2, $response_pdf2);
//    $target_file3 = "$hw_id 3.pdf";
//    file_put_contents("downloaded_files/" . $target_file3, $response_pdf3);
//    $target_file4 = "$hw_id 4.pdf";
//    file_put_contents("downloaded_files/" . $target_file4, $response_pdf4);
        $file0_encoded = base64_encode($response_pdf0);
        $file1_encoded = base64_encode($response_pdf1);
//    $file2_encoded = base64_encode($response_pdf2);
//    $file3_encoded = base64_encode($response_pdf3);
//    $file4_encoded = base64_encode($response_pdf4);
//    $callback_body = base64_encode($raw_json_for_sendgrid);
//    $file0_encoded = base64_encode("downloaded_files/" . $target_file0);
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("radhack242@gmail.com", "HelloWorks Platform");
        $email->setSubject("HelloWorks callback received");
        $email->addTo("ram.muthukrishnan@hellosign.com", "Ram Rammuthukrishnan");
        $email->addBcc("radhack242@gmail.com", "Alex Griffen");
        $body = "<p>Here's the JSON in the HelloWorks callback for $hw_id</p><br /><br />$json_pretty";
        $email->addContent(
                "text/html", "$body"
        );
        $email->addAttachment($file0_encoded, "application/pdf", "Costco Wholesale.pdf");
        $email->addAttachment($file1_encoded, "application/pdf", "Costco Wholesale - audit_trail.pdf");
        $sendgrid = new \SendGrid("$sendgrid_api_key");
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

// print everything out
        print_r($response);
    }

    // ******************
    //   END HELLOWORKS
    // ******************
     
    // ******************
    // HelloSign Callback
    // ******************

    $data = json_decode($_POST['json']);
    if ($data != null) { //only send the response if I'm hit with a POST
        echo 'Hello API Event Received';
    }

    if (isset($_GET['type'])) {
        if (htmlspecialchars($_GET['type']) == "outbound") {
            $hf_callback = true;
            goto hf_callback;
            //just to get rid of the php warning that $_GET['type'] isn't set
        } else {
            goto hf_callback;
        }
    }

    //check for validitiy
    $hash_check_failed = 0; //initialize the flag
    $callback_event = new HelloSign\Event($data);
    if ($callback_event->isValid($api_key) == FALSE) {
        $hash_check_failed = 1;
        goto invalid_hash;
    }
// Get the event type.
    $event_type = $data->event->event_type;
    $reported_app = $data->event->event_metadata->reported_for_app_id;

// The signature_request_all_signed event is called whenever the signature
// request is completely signed by all signees, HelloSign has processed
// the document and has it available for download.
    if ($reported_app === "$client_id") {
        if ($event_type === 'signature_request_all_signed') {
            $client = new HelloSign\Client($api_key);
            $signature_request_id = $data->signature_request->signature_request_id;
            //get the file_url to pass in the email
            $get_file = $client->getFiles($signature_request_id);
            $files_url = $get_file->file_url;
            error_log($files_url);

// also trigger an email 
// right now I'm just hardcoding the receipient, but
// this could be updated to work with a database
// to make the receipient smart
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Signature Request All Signed",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />and the files can be downloaded from <a href='$files_url'>this page.</a><br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Callback Test",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
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
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Signature Request Sent",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
        } elseif ($event_type === 'file_error') {
            $signature_request_id = $data->signature_request->signature_request_id;
            $event_time = $data->event->event_time;
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "File Error",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Unknown Error",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Signature Request Email Bounced",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Signature Request Declined",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
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
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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
            $sendgrid = new SendGrid($sendgrid_apikey);
            $url = 'https://api.sendgrid.com/';
            $pass = $sendgrid_apikey;

            $params = array(
                'to' => "radhack242+$event_type@gmail.com",
                'toname' => "Event Not Setup",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Prod $event_type received",
                'html' => "<strong>$signature_request_id</strong><br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
            );

            $request = $url . 'api/mail.send.json';

// Generate curl request
            $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
            curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
            curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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

        $signature_request_id = $data->signature_request->signature_request_id;
        $event_time = $data->event->event_time;
        $event_hash = $data->event->event_hash;
        $sendgrid = new SendGrid($sendgrid_apikey);
        $url = 'https://api.sendgrid.com/';
        $pass = $sendgrid_apikey;

        $params = array(
            'to' => "radhack242@gmail.com",
            'toname' => "Hash Failed",
            'from' => "radhack242@gmail.com",
            'fromname' => "Simple PHP",
            'subject' => "Prod Hash Check Failed",
            'html' => "<p>Hash verification failed on the Production app.</p><br />"
            . "<p><pre>$event_type</pre> is the event type</p><br />"
            . "<p><pre>$signature_request_id</pre> is the signature request ID</p><br />"
            . "<p><pre>$event_time</pre> is the event time.</p><br />"
            . "<p><pre>$event_hash</pre> is the event hash.</p>",
        );

        $request = $url . 'api/mail.send.json';

// Generate curl request
        $session = curl_init($request);
// Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_apikey));
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

    hf_callback:
    if ($hf_callback = true) {
        $sendgrid = new SendGrid($sendgrid_api_key);
        $url = 'https://api.sendgrid.com/';
        $pass = $sendgrid_api_key;

        if (htmlspecialchars($_GET["type"] == "inbound")) {
            $event_time = $data->event->event_time;
            $from = $data->transmission->from;
            $recipient = $data->transmission->transmissions->recipient;
            $tranmission_id = $data->transmission->transmissions->transmission_id;

            $params = array(
                'to' => "radhack242@gmail.com",
                'toname' => "HelloFax Fax Inbound",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Inbound Fax Received",
                'html' => "<h1>You've Received A Fax!</h1><p>$event_time is the time I received the fax</p><p>$from is who it's from</p><p>$recipient is who it was sent to</p><p>$tranmission_id is the ID of the transmission</p>",
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
        } elseif (htmlspecialchars($_GET["type"] == "outbound")) {
            date_default_timezone_set('Etc/GMT');
            $type_code = $data->Transaction->TypeCode;
            $status_code = $data->Transaction->StatusCode;
            $error_code = $data->Transaction->ErrorCode;
            if ($error_code == null) {
                $error_code = "(there was no error code)";
            }
            $created_at = date('Y-m-d\TH:i:s', strtotime(gmdate("Y-m-d\TH:i:s\Z", $data->Transaction->CreatedAt) . "- 7 hours"));
            $updated_at = date('Y-m-d\TH:i:s', strtotime(gmdate("Y-m-d\TH:i:s\Z", $data->Transaction->UpdatedAt) . "- 7 hours"));
            $recipient = $data->Transaction->To;
            $from = $data->Transaction->From;
            $tranmission_id = $data->Transaction->Guid;
            $num_pages_billed = $data->Transaction->NumPagesBilled;

            $params = array(
                'to' => "radhack242@gmail.com",
                'toname' => "HelloFax Fax Sent",
                'from' => "radhack242@gmail.com",
                'fromname' => "Simple PHP",
                'subject' => "Fax Sent!",
                'html' => "<h1>You've Sent A Fax!</h1>"
                . "<p>$created_at is the time/date I sent the fax</p>"
                . "<p>$updated_at is the time/date I received this</p>"
                . "<p>$from is who it's from</p>"
                . "<p>$recipient is who it was sent to</p>"
                . "<p>$tranmission_id is the ID of the transmission</p>"
                . "<p>$type_code is the type of Transaction</p>"
                . "<p>$status_code is the status of the Transaction</p>"
                . "<p>$error_code is the error code</p>"
                . "",
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
            // ignore it (this DEFINITELY won't come back to bite me in the ass...)
        }
    }
    ?>
</body>
</html>