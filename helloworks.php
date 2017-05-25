<!DOCTYPE html>
<html>
    <head>
        <title>HelloWorks W-9</title>
        <link rel="stylesheet" type="text/css" href="newcss.css" />
        <link rel="shortcut icon" href="/helloworks-fav.ico" />
    </head>
    <body>
        <?php
        $hw_email = $_POST['hw_email'];
        $hw_name = $_POST['hw_name'];
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

        $curl_post = curl_init();

        curl_setopt_array($curl_post, array(
            CURLOPT_URL => "https://api.helloworks.com/v2/flow/H36WKL66kM4UgDrp/instance",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "identity%5Btype%5D=email&identity%5Bvalue%5D=$hw_email&identity%5Bfull_name%5D=$hw_name&settings%5Bcallback_url%5D=https%3A%2F%2F9060677a.ngrok.io%2Fcallback.php&identity%5Bverification%5D=code&settings%5Bredirect_url%5D=https%3A%2F%2F9060677a.ngrok.io",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $bearer",
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
        $hw_sign_url = $parsed_post->object->url;
        $hw_instance_id = $parsed_post->object->id;
        include('db.php');

        echo "<h1>The process has started!</h1><br />";
        echo "If you're not automatically redirected, click <a href=$hw_sign_url target=\"_blank\">this link</a><br />";
//        echo "Click <a href=$hw_sign_url target=\"_blank\">this link</a> if you're not automatically redirected.";
        ?>
        <script type="text/javascript">
//            var hwurl = "<?php echo $hw_sign_url?>";
//            window.location.href = hwurl;
            </script>
    </body>
</html>