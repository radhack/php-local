<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bug Testing</title>
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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://50cff1d3451e96e91333185a91f6a5e1ccab34094fe2424a1ecbe88e580192ae:@api.hellosign.com/v3/unclaimed_draft/create_embedded",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"client_id\"\r\n\r\nd7219512693825facdd9241f458decf2\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"test_mode\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"subject\"\r\n\r\nusing postman\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"message\"\r\n\r\nThree Signers multiple pages\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"signers[0][email_address]\"\r\n\r\nalex@hellosign.com\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"signers[0][name]\"\r\n\r\nMr Postman\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"signers[1][email_address]\"\r\n\r\nalex+sdfsj@hellosign.com\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"signers[1][name]\"\r\n\r\nMrs Postman\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"signers[2][email_address]\"\r\n\r\nalex+lksdkfjjr@hellosign.com\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"signers[2][name]\"\r\n\r\nPostman Jr\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"requester_email_address\"\r\n\r\nradhack242@gmail.com\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"is_for_embedded_signing\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[0]\"\r\n\r\nhttps://docs.google.com/document/d/1d5GC4vaPeua-H5KA77bYG9-LMra3-PHzE54zP4yjGM4/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[1]\"\r\n\r\nhttps://docs.google.com/document/d/1XEi6gf84x7ZQh1EXJEzq3uNW-R8cTLG6vQcs56c7zbY/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[2]\"\r\n\r\nhttps://docs.google.com/document/d/19G_7iGm3MG_qhMvWJ_A3JaF27g5DVODPHflFwa6IL9o/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[3]\"\r\n\r\nhttps://docs.google.com/document/d/1ns55PuRwD0--zmdwh4KN4JzEIUtD3Nc5KGTDQAloPtk/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[4]\"\r\n\r\nhttps://docs.google.com/document/d/1TkiACYSueqNZWrNd6VZeLIP0l-9fdMOkKr_6DVWam7E/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[5]\"\r\n\r\nhttps://docs.google.com/document/d/1wbtCImBcxtmJAZJinYSNrA86u1ShDGKa42PjT4bCRms/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[6]\"\r\n\r\nhttps://docs.google.com/document/d/1t4azpSjTjaqMQfmfK_Sa23iyTT_Z56AgmwHWZpUSQro/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[7]\"\r\n\r\nhttps://docs.google.com/document/d/1tiGUotWzyPFGQK-PqiltBX8a0lcI0ok3bEegDpNMGew/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[8]\"\r\n\r\nhttps://docs.google.com/document/d/1pBDPeHRRVC8rCnr1NVBlayByr0ZcwADxUp0S3GFtF9Q/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[9]\"\r\n\r\nhttps://docs.google.com/document/d/1T_jJagMcO1nANf0-hJwqPY6eyLCxRedDYeYuK2W1INo/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[10]\"\r\n\r\nhttps://docs.google.com/document/d/1b3zHRTMEVrHomNHcBpEI-WiJuoKktEnL-6f05FM2mbY/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[11]\"\r\n\r\nhttps://docs.google.com/document/d/10uxt6kEfY4doVtdqdBYPTajSbQ2ZsNEzgiF9MzvKWOo/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"file_url[12]\"\r\n\r\nhttps://docs.google.com/document/d/1zKdsL8L0pc6PGhZPxHfpF69EDZXxtwJw3pRqSuRyiro/edit?usp=sharing\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
        ?>
    </body>
</html>
