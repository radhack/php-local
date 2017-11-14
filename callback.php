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
        $form0_name = $json->forms[0]->name;
        $form0_url = $json->forms[0]->document->url;
        $form1_name = $json->forms[1]->name;
        $form1_url = $json->forms[1]->document->url;
        $form2_name = $json->forms[2]->name;
        $form2_url = $json->forms[2]->document->url;
        $form3_name = $json->forms[3]->name;
        $form3_url = $json->forms[3]->document->url;
        $form4_name = $json->forms[4]->name;
        $form4_url = $json->forms[4]->document->url;
        
        foreach($json as $obj) {
            
        }
        
       // GET the JWT
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://api.helloworks.com/v2/token/tdUNBn2TrWzVEoFD", //this is the Alex+Booker API key information
            CURLOPT_URL => "https://api.helloworks.com/v2/token/jf1DnGMBBW9VOl21", //this is the Alex+viewstaging API Key information
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
//                "authorization: Bearer eW8gYCY2fz9MMnkUcKPP7VbK2GtPNkPUEOnaFqU4", //use this with Alex+Booker
                "authorization: Bearer uxLit7EZGORNbOuLfrT3EMWOxxj4zbmNR0aLgzxf", //use this with Alex+viewstaging
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

//        form0 section
        $curl0 = curl_init();

        curl_setopt_array($curl0, array(
            CURLOPT_URL => "$form0_url",
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
        
//        form1 section
        $curl1 = curl_init();

        curl_setopt_array($curl1, array(
            CURLOPT_URL => "$form1_url",
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
        
        //        form2 section
        $curl2 = curl_init();

        curl_setopt_array($curl2, array(
            CURLOPT_URL => "$form2_url",
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

        $response_pdf2 = curl_exec($curl2);
        $err = curl_error($curl2);

        curl_close($curl2);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response_pdf2;
        }
        
        //        form3 section
        $curl3 = curl_init();

        curl_setopt_array($curl3, array(
            CURLOPT_URL => "$form3_url",
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

        $response_pdf3 = curl_exec($curl3);
        $err = curl_error($curl3);

        curl_close($curl3);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response_pdf3;
        }
        
        //        form4 section
        $curl4 = curl_init();

        curl_setopt_array($curl4, array(
            CURLOPT_URL => "$form4_url",
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

        $response_pdf4 = curl_exec($curl4);
        $err = curl_error($curl4);

        curl_close($curl4);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response_pdf4;
        }

        $target_file0 = "$hw_id 0.pdf";
        file_put_contents("downloaded_files/" . $target_file0, $response_pdf0);
        $target_file1 = "$hw_id 1.pdf";
        file_put_contents("downloaded_files/" . $target_file1, $response_pdf1);
        $target_file2 = "$hw_id 2.pdf";
        file_put_contents("downloaded_files/" . $target_file2, $response_pdf2);
        $target_file3 = "$hw_id 3.pdf";
        file_put_contents("downloaded_files/" . $target_file3, $response_pdf3);
        $target_file4 = "$hw_id 4.pdf";
        file_put_contents("downloaded_files/" . $target_file4, $response_pdf4);
        $file0_encoded = base64_encode($response_pdf0);
        $file1_encoded = base64_encode($response_pdf1);
        $file2_encoded = base64_encode($response_pdf2);
        $file3_encoded = base64_encode($response_pdf3);
        $file4_encoded = base64_encode($response_pdf4);
        $to = new SendGrid\Email("HelloWorks Signer", "radhack242@gmail.com");
        $from = new SendGrid\Email("HelloWorks Platform", "radhack242@gmail.com");
        $subject = "HelloWorks callback received";
        $content = new SendGrid\Content("text/html", "<pre>$status</pre> is the status<br /><br />$identity is the email of the signer<br /><pre>$hw_id</pre> is the instance id<br /><pre>$form0_name <br /> $form1_name <br /> $form2_name <br /> $form3_name <br /> $form4_name</pre> are the form names<br />");
        $attachment0 = new SendGrid\Attachment();
        $attachment0->setType("application/pdf");
        $attachment0->setDisposition("attachment");
        $attachment0->setFilename($target_file0);
        $attachment0->setContent($file0_encoded);
        $attachment1 = new SendGrid\Attachment();
        $attachment1->setType("application/pdf");
        $attachment1->setDisposition("attachment");
        $attachment1->setFilename($target_file1);
        $attachment1->setContent($file1_encoded);
        $attachment2 = new SendGrid\Attachment();
        $attachment2->setType("application/pdf");
        $attachment2->setDisposition("attachment");
        $attachment2->setFilename($target_file2);
        $attachment2->setContent($file2_encoded);
        $attachment3 = new SendGrid\Attachment();
        $attachment3->setType("application/pdf");
        $attachment3->setDisposition("attachment");
        $attachment3->setFilename($target_file3);
        $attachment3->setContent($file3_encoded);
        $attachment4 = new SendGrid\Attachment();
        $attachment4->setType("application/pdf");
        $attachment4->setDisposition("attachment");
        $attachment4->setFilename($target_file4);
        $attachment4->setContent($file4_encoded);
        $email = new SendGrid\Mail($from, $subject, $to, $content);
        $email->addAttachment($attachment0);
        $email->addAttachment($attachment1);
        $email->addAttachment($attachment2);
        $email->addAttachment($attachment3);
        $email->addAttachment($attachment4);

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


    if ($data != null) { //only send the response if I'm hit with a POST that has an object called 'json'
        echo 'Hello API Event Received';
    } else {
        goto invalid_hash; // basically skip everything
    }

    if (isset($_GET['type'])) {
        if (htmlspecialchars($_GET['type'])== "outbound") {
        $hf_callback = true;
        goto hf_callback;
        //just to get rid of the php warning that $_GET['type'] isn't set
        } else {
            goto hf_callback; 
        }
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
            $requester = $data->signature_request->requester_email_address;
            $signer_email = $data->signature_request->signatures->signer_email_address;
            $signer_name = $data->signature_request->signatures->signer_name;

            // Here you define where the file should download to. This should be
            // customized to your app's needs.
            $client->getFiles($signature_request_id, "downloaded_files/" . $signature_request_id . ".pdf", HelloSign\SignatureRequest::FILE_TYPE_PDF);

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
            if ($conn->query($sql) == FALSE) {
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
                echo "*_?>*_?>*_?>*_?> skipping <br />";
//                $event_time = $data->event->event_time;
//                $sendgrid = new SendGrid($sendgrid_api_key);
//                $url = 'https://api.sendgrid.com/';
//                $pass = $sendgrid_api_key;
//
//                $params = array(
//                    'to' => "radhack242+$event_type@gmail.com",
//                    'toname' => "Signature Request Sent",
//                    'from' => "radhack242@gmail.com",
//                    'fromname' => "Simple PHP",
//                    'subject' => "$event_type received",
//                    'html' => "<strong>$signature_request_id</strong> Error INSERTing (lol): $conn->error <br />Is the signature_request_id<br />$event_type was received at $event_time<br />",
//                );
//
//                $request = $url . 'api/mail.send.json';
//
//// Generate curl request
//                $session = curl_init($request);
//// Tell PHP not to use SSLv3 (instead opting for TLS)
//                curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
//                curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $sendgrid_api_key));
//// Tell curl to use HTTP POST
//                curl_setopt($session, CURLOPT_POST, true);
//// Tell curl that this is the body of the POST
//                curl_setopt($session, CURLOPT_POSTFIELDS, $params);
//// Tell curl not to return headers, but do return the response
//                curl_setopt($session, CURLOPT_HEADER, false);
//                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
//
//// obtain response
//                $response = curl_exec($session);
//                curl_close($session);
//
//// print everything out
//                print_r($response);
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
    if ($hash_check_failed == 1 & $event_type != "transmission_received") {

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
                'subject' => "Hash Check Failed and Recorded",
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
            $created_at = date('Y-m-d\TH:i:s', strtotime(gmdate("Y-m-d\TH:i:s\Z", $data->Transaction->CreatedAt)."- 7 hours"));
            $updated_at = date('Y-m-d\TH:i:s', strtotime(gmdate("Y-m-d\TH:i:s\Z", $data->Transaction->UpdatedAt)."- 7 hours"));
            $recipient =  $data->Transaction->To;
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
        }
    } else {
        // ignore it (this DEFINITELY won't come back to bite me in the ass...)
    }
    ?>
</body>
</html>