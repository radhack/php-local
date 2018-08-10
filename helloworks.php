<!DOCTYPE html>
<html>
    <head>
        <title>HelloWorks W-9</title>
        <link rel="stylesheet" type="text/css" href="newcss.css" />
        <link rel="shortcut icon" href="/helloworks-fav.ico" />
    </head>
    <body>
        <?php
        include_once "auth.php";
        
        $hw_email = urlencode($_POST['hw_email']);
        $hw_name = $_POST['hw_name'];
//        echo("<br /> $hw_email <br />");
//        echo("$hw_name <br />");
        
//        $verification_type = "link";
//        if (isset($_POST['hw_send_code'])) {
//            $verification_type = "code";
//        }
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://api.helloworks.com/v3/token/tdUNBn2TrWzVEoFD", //this is the Alex+Booker API key information
//            CURLOPT_URL => "https://api.helloworks.com/v3/token/rIlk5pIBAmRStex9", // this is the June12thKey information
            CURLOPT_URL => "https://api.helloworks.com/v2/token/DB6LbyftGsu63VBW", // this is hstests
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
//                "authorization: Bearer eW8gYCY2fz9MMnkUcKPP7VbK2GtPNkPUEOnaFqU4",
//                "authorization: Bearer uxLit7EZGORNbOuLfrT3EMWOxxj4zbmNR0aLgzxf", //use this with Alex+viewstaging
//                "authorization: Bearer $hw_apikey_test",
                "authorization: Bearer aLAUJFBMdMkiBYmDHQN1VOeovFkTXdBjyaNabPiM", // this is hstests
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $parsed = json_decode($response);
        
//        print_r($parsed);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
//            echo $parsed->object->value;
            echo "<br />";
        }

        $bearer = "Bearer " . $parsed->object->value;
        
        echo("<br /> $bearer");
        
//        print_r($bearer);

        $curl_post = curl_init();

        curl_setopt_array($curl_post, array(
            CURLOPT_URL => "https://api.helloworks.com/v2/view/KF9FBIAnAfnzmq3Y/instance", // this is hstest
//            CURLOPT_URL => "https://api.helloworks.com/v2/view/1fLQvaAFk4zlM0P5/instance", // update to v3/workflow/1fLQvaAFk4zlM0P5
//            CURLOPT_URL => "https://api.helloworks.com/v2/view/1fLQvaAFk4zlM0P5/instance",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS => "identity%5Btype%5D=email&identity%5Bvalue%5D=$hw_email&identity%5Bfull_name%5D=$hw_name&settings%5Bcallback_url%5D=https%3A%2F%2Fhstests.ngrok.io%2Fcallback.php&identity%5Bverification%5D=code&settings%5Bredirect_url%5D=https%3A%2F%2Fhstests.ngrok.io",
            CURLOPT_POSTFIELDS => "identity%5B"
            . "type%5D=email"
            . "&"
            . "identity%5B"
            . "value%5D=$hw_email"
                . "&"
            . "identity%5B"
            . "full_name%5D=$hw_name"
                . "&"
            . "settings%5B"
            . "callback_url%5D=https%3A%2F%2Fhstests.ngrok.io%2Fcallback.php"
            . "&"
            . "identity%5Bverification%5D=code"
            . "&settings%5B"
            . "redirect_url%5D=https%3A%2F%2Fhstests.ngrok.io",
//            CURLOPT_POSTFIELDS => "participants%5Bsigner%5D%5Btype%5D=email"
//            . "&"
//            . "participants%5Bsigner%5D%5Bvalue%5D=$hw_email"
//                . "&"
//            . "participants%5Bsigner%5D%5Bfull_name%5D=$hw_name"
//                . "&"
//            . "settings%5Bglobal%5D%5Bcallback_url%5D=https%3A%2F%2Fhstests.ngrok.io%2Fcallback.php"
//            . "&"
//            . "settings%5Bstep1%5D%5Bredirect_url%5D=https%3A%2F%2Fhstests.ngrok.io",
            CURLOPT_HTTPHEADER => array(
                "authorization: $bearer",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response_post = curl_exec($curl_post);
        $err_post = curl_error($curl_post);

        curl_close($curl_post);

        if ($err_post) {
            echo "cURL Error #:" . $err_post;
        } else {
            echo $response_post;
            echo " <br />";
        }

        $parsed_post = json_decode($response_post);
        echo "<br />";
//        print_r($parsed_post);
        echo "<br />";
//        $hw_sign_url = $parsed_post->object->url; // no more url
        $hw_instance_id = $parsed_post->object->id;
//        include('db.php');

        echo "<h1>The process has started! Please check your phone or email.</h1><br />";
//        echo "$hw_sign_url <br />";
//        echo "Click <a href=$hw_sign_url target=\"_blank\">this link</a> if you're not automatically redirected.";
        ?>
<!--        <script type="text/javascript">
            var hwurl = "<?//php echo $hw_sign_url?>";
            window.location.href = hwurl;
        </script>-->
    </body>
</html>