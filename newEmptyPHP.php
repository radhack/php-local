<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>New Empty</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="//s3.amazonaws.com/cdn.hellosign.com/public/js/hellosign-embedded.LATEST.min.js"></script>
        <!--<script type="text/javascript" src="//s3.amazonaws.com/cdn.hellofax.com/js/embedded.js"></script>-->
        <link rel="stylesheet" type="text/css" href="newcss.css" />
        <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
        <link rel="icon" type="image/png" href="/favicon-32x32.png"/>
        <link rel="icon" type="image/png" href="/favicon-16x16.png"/>
        <link rel="manifest" href="/manifest.json" />
        <link rel="mask-icon" href="/safari-pinned-tab.svg"/>
    </head>
    <body>
        <script>
            function reverse(s){
                return s.split("").reverse().join("");
            }
            var string = reverse("just seeing how hard it is to reverse a string in javascript");
            console.log(string);
        </script>
        <?php
        require_once 'vendor/autoload.php';
////        $freeapi = 1;
        include('auth.php');
        $client = new HelloSign\Client("$api_key");
//        $i = 0;
//        while ($i < 1000) {
//            echo("$i is the number of this request <br />");
//            $i++;
//            try {
//                $request = new HelloSign\TemplateSignatureRequest;
////                $request->enableTestMode();
//                $request->setTitle("$i");
//                $request->setSubject("$i signature request");
//                $request->setMessage('Awesome, right?');
//                $request->setSigner('Role1', "alex+$i@hellosign.com", 'Johnny Mc.Dotty and Mc-Dashy');
//                $request->setSigner('Role2', "alex+$i.more@hellosign.com", 'and Jill');
////                $request->setSigner('Role3', 'jack@example.com', 'Went');
////                $request->setSigner('Role4', 'jack@example.com', 'Up The');
////                $request->setSigner('Role5', 'jack@example.com', 'Hill');
////                $request->setCustomFieldValue('Cost', "$100,000,000 and all of the things that go along with things like this are too much for lorem ipsum to handle and all that it represents and all that accounts for all the things in Maui and Thailand.");
////                $request->setCustomFieldValue('Amount', "There's not much", "Role1");
////                $request->setCustomFieldValue("Applicant", "Bobs's the name", "Role1");
//                        $request->setCustomFieldValue('Test Merge', '$100,000,000');
//                        $request->setCustomFieldValue('Test Merge 1', "There's not much here because of lorum ipsum and all that it represents and all that accounts for all the things in Maui and Thailand, which are all mostly connected through wormholes and zombies.");
//                        $request->setCustomFieldValue("Test Merge 3", "Bobs's the name");
//                        $request->setCustomFieldValue("Test Merge 2", true);            
//                $request->setTemplateId('5eafe0c773034d3d1e5dffda2580ae3b46014b44');
//
//                // Send it to HelloSign
//                $response = $client->sendTemplateSignatureRequest($request, $client_id);
////                $response = $client->createEmbeddedSignatureRequest($embedded_request);
//                // Grab the signature ID for the signature page that will be embedded in the page             
//            } catch (Exception $err) {
//                $err_message = $err->getMessage();
//                echo("$err_message");
//                echo("<br />");
//                
//            }
//        }
        $embedded_response = $client->getEmbeddedSignUrl("f843813691c860eda923b99cc7cb6b3b");
        $sign_url = $embedded_response->getSignUrl();

        // call the html page with the embedded.js lib and HelloSign.open()
        include('signerpage.php');
       ?>
    </body>
</html>