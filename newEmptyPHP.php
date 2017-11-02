<!DOCTYPE html>
<html>
    <head>
        <title>New Empty PHP</title>
    </head>
    <body>
        <?php
        require_once 'vendor/autoload.php';
        include('auth.php');

        $client = new HelloSign\Client($api_key);

        $sig_req_response = $client->getFiles("6adc00d19d91679ec47c79e4ed180fd33121123b", '', "link");
        $file_url = $sig_req_response->file_url;

        echo("<br />");
//        print_r($file_url);
//echo "$file_url";
        ?><iframe src="<?php echo "$file_url" ?>" height="900" width="800"></iframe></body></html>
