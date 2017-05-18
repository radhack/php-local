<!DOCTYPE html>
<html>
<head>
    <title>oAuth Handler</title>
    <link rel="stylesheet" type="text/css" href="newcss.css" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" href="/favicon-32x32.png"/>
    <link rel="icon" type="image/png" href="/favicon-16x16.png"/>
    <link rel="manifest" href="/manifest.json" />
    <link rel="mask-icon" href="/safari-pinned-tab.svg"/>
</head>
<body>
    <?php
//if people find their way here, give them a way to get back home
    echo '<a href="index.php">GO HOME YOU ARE DRUNK<br /></a>';

    require_once 'vendor/autoload.php';

    $oauth_code = $_GET['code'];
    $oauth_state = $_GET['state'];
    $skip_yes = 0;
    if ($oauth_code . $oauth_state == null) {
        $skip_yes = 1;
        goto skip;
    }

    $sendgrid_apikey = getenv('SENDGRID_PHP_APIKEY') ? getenv('SENDGRID_PHP_APIKEY') : '';

    $sendgrid = new SendGrid($sendgrid_apikey);
    $url = 'https://api.sendgrid.com/';
    $pass = $sendgrid_apikey;

    $params = array(
        'to' => "radhack242+oauth@gmail.com",
        'toname' => "oAuth Page Hit",
        'from' => "radhack242@gmail.com",
        'fromname' => "oAuth Page was hit",
        'subject' => "oAuth Page was hit",
        'html' => "<strong>$oauth_code</strong><br />Is the oauth code<br />$oauth_state is the state.<br />",
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
//    print_r($response);

    skip:
        if ($skip_yes == 1){
        echo "You didn't enter the magic words<br />";
        }
     ?>
</body>
</html>