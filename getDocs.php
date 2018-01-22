<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Get Your Docs</title>
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
        $hfapi = 0; //set to zero for standard, 1 for hfapi subscription
        include('auth.php');
//        $client_id = '3e3f283135002d1993a92124341193df';
        echo '<br /><a href="index.php">ARE YOU TOO GOOD FOR YOUR HOME?</a><br />';
        if (isset($_SESSION['signature_request_id'])) {
            try {
                $filename = "downloaded_files/".$_SESSION['signature_request_id'].".pdf";
                $client = new HelloSign\Client($api_key);
                $file = $client->getFiles($_SESSION['signature_request_id'], $filename , HelloSign\SignatureRequest::FILE_TYPE_PDF);
                echo "<iframe src=\"$filename\" width=\"100%\" style=\"height:880px\"></iframe>";
            } catch (Exception $e) {
                $message = $e->getMessage();
                print_r($message);
                echo("<br />Looks like there was an error - please wait while I try again...");
                ?><script>location.reload(true);</script><?php
            }
        } elseif (isset($_GET['signature_request_id'])) {
            $filename = "downloaded_files/".$_GET['signature_request_id'].".pdf";
            $client = new HelloSign\Client($api_key);
            try { 
                $file = $client->getFiles($_GET['signature_request_id'], $filename , HelloSign\SignatureRequest::FILE_TYPE_PDF);
                echo "<iframe src=\"$filename\" width=\"100%\" style=\"height:880px\"></iframe>";
            } catch (Exception $err) {
                if ($err->getMessage() == "Not found") {
                    echo("The signature request id that you're looking for was not found. Time to go home little buddy.");
                }
            }
        } else {
            echo("What are you doing here? You're missing the stuff needed to make this page work, so you need to...<br />");
            echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
        }

