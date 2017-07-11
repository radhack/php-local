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
        if (isset($_POST['hw_email'])){
        $hw_email = $_POST['hw_email'];
        $hw_name = $_POST['hw_name'];
        } else {
            echo 'wtf happened - check yo shit <br />';
            echo "click <a href=index.php>this link</a><br />";
        }
        $verification_type = "link";
        if (isset($_POST['hw_send_code'])) {
            $verification_type = "code";
        }
        $city = "San Francisco";
        $title = "Employee";
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.helloworks.com/v2/token/TRThUyspqeur25Ka",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $hw_apikey_test",
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
        
//        print_r($bearer);

        $curl_post = curl_init();

        curl_setopt_array($curl_post, array(
            CURLOPT_URL => "https://api.helloworks.com/v2/view/7K2iuZtmmAto4H8k/instance",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "identity%5Btype%5D=email&identity%5Bvalue%5D=$hw_email&identity%5Bfull_name%5D=$hw_name&merge_fields%5BaM7amjdYvV1pfKwu%5D%5BTitle%5D=$title&merge_fields%5BJUth2jLJRhk5MDdI%5D%5BRequesterInfo%5D=$city&settings%5Bcallback_url%5D=https%3A%2F%2Fhstests.ngrok.io%2Fcallback.php&identity%5Bverification%5D=$verification_type&settings%5Bredirect_url%5D=https%3A%2F%2Fhstests.ngrok.io",
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
//            echo $response_post;
            echo " <br />";
        }

        $parsed_post = json_decode($response_post);
        echo "<br />";
//        print_r($parsed_post);
        echo "<br />";
        $hw_sign_url = $parsed_post->url;
        $hw_instance_id = $parsed_post->id;
        include('db.php');

        echo "<h1>The process has started!</h1><br />";
        echo "If you're not automatically redirected, click <a href=$hw_sign_url target=\"_blank\">this link</a><br />";
//        echo "Click <a href=$hw_sign_url target=\"_blank\">this link</a> if you're not automatically redirected.";
        ?>
        <script type="text/javascript">
            var hwurl = "<?php echo $hw_sign_url?>";
            window.location.href = hwurl;
            </script>
    </body>
</html>