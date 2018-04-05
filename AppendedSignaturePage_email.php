<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Appended Signature Page</title>
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
        require_once 'vendor/autoload.php';
        include('auth.php');
        
        $signer_email = $_POST['signeremail'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploadedfile"]["name"]);
        $uploadOk = 1; //this is used if the other if statements are used
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "ppsx" && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "tif" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt" && $imageFileType != "html" && $imageFileType != "gif") {
            echo "Sorry, only doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, <br />"
            . "xlsx, txt, html, and gif are allowed at this point <br />";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            goto skip;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadedfile"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["uploadedfile"]["name"]) . " has been uploaded. <br />";
            } else {
                echo "Sorry, there was an error uploading your file. <br />";
                $uploadOk = 0;
                goto skip;
            }
        }
        
        // Instance of a client for you to use for calls
        $client = new HelloSign\Client($api_key);

        // Example call with logging for embedded requests
        $request = new HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->setTitle("Testing");
        $request->setSubject('My First embedded signature request');
        $request->setMessage('Awesome, right?');
        $request->addSigner("$signer_email", 'Testing Signer');
        $request->addSigner("alex+signer1@hellosign.com", "Alex");
        // $request->setAllowDecline(true); // uncomment this when allowDecline is built into the PHP SDK
        $request->addFile("$target_file");

        rename($target_file, "$target_file.embSigReq");
        // Turn it into an embedded request
//        $embedded_request = new HelloSign\EmbeddedSignatureRequest($request, $client_id);

        // Send it to HelloSign
//        $response = $client->createEmbeddedSignatureRequest($embedded_request);
        $response = $client->sendSignatureRequest($request, $client_id);
goto skip;
        // Grab the signature ID for the signature page that will be embedded in the page
        $signature_request_id = $response->signature_request_id;
        $signatures = $response->getSignatures();
        $signature_id = $signatures[0]->getId();
        $createdHow = "appendedSignaturePage_email";
        include('db.php');

        // send email region
        $from = new SendGrid\Email(null, "test@example.com");
        $subject = "Hello World from the SendGrid PHP Library!";
        $to = new SendGrid\Email("Alex", "$signer_email");
        $content = new SendGrid\Content("text/html", "<html>
                       <head>
                       <title></title>
                       <meta http-equiv = \"Content-Type\" content = \"text/html; charset=utf-8\" />
                       <meta name = \"viewport\" content = \"width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1\" />
                       <!--[if!mso]><!-->
                       <meta http-equiv = \"X-UA-Compatible\" content = \"IE=Edge\" />
                       <!-- <![endif] -->
                       <!--[if (gte mso 9)|(IE)]><style type = \"text/css\">
                       table {border-collapse: collapse;
                       }
                       table, td {mso-table-lspace: 0pt;
                       mso-table-rspace: 0pt;
                       }
                       img {-ms-interpolation-mode: bicubic;
                       }
                       </style>
                       <![endif] -->
                       <style type = \"text/css\">body {
                               color: #000000;
                        }
                        body a {
                            color: #1188e6;
                            text-decoration: none;
                        }
                        p { margin: 0;
                            padding: 0;
                        }
                        table[class = \"wrapper\"] {
                            width:100%!important;
                            table-layout: fixed;
                            -webkit-font-smoothing: antialiased;
                            -webkit-text-size-adjust: 100%;
                            -moz-text-size-adjust: 100%;
                            -ms-text-size-adjust: 100%;
                        }
                        img[class = \"max-width\"] {
                            max-width: 100%!important;
                        }
                        @media screen and (max-width:480px) {
                            .preheader .rightColumnContent,
                            .footer .rightColumnContent {
                                text-align: left!important;
                            }
                            .preheader .rightColumnContent div,
                            .preheader .rightColumnContent span,
                            .footer .rightColumnContent div,
                            .footer .rightColumnContent span {
                                text-align: left!important;
                            }
                            .preheader .rightColumnContent,
                            .preheader .leftColumnContent {
                                font-size: 80%!important;
                                padding: 5px 0;
                            }
                            table[class = \"wrapper-mobile\"] {
                                width: 100%!important;
                                table-layout: fixed;
                            }
                            img[class = \"max-width\"] {
                                height: auto!important;
                            }
                            a[class = \"bulletproof-button\"] {
                                display: block!important;
                                width: auto!important;
                                font-size: 80%;
                                padding-left: 0!important;
                                padding-right: 0!important;
                            }
                            /*2 columns */
                            #templateColumns{
                                width:100%!important;
                            }

                            .templateColumnContainer{
                                display:block!important;
                                width:100%!important;
                                padding-left: 0!important;
                                padding-right: 0!important;
                            }
                        }
                       </style>
                       <style type = \"text/css\">body, p, div { font-family: arial, sans-serif;
                        }
                       </style>
                       </head>
                       <body data-attributes = \"%7B%22dropped%22%3Atrue%2C%22bodybackground%22%3A%22%23FFFFFF%22%2C%22bodyfontname%22%3A%22arial%2Csans-serif%22%2C%22bodytextcolor%22%3A%22%23000000%22%2C%22bodylinkcolor%22%3A%22%231188e6%22%2C%22bodyfontsize%22%3A%2214px%22%7D\" style = \"min-width: 100%; margin: 0; padding: 0; font-size: 14pxpx; font-family: arial,sans-serif; color: #000000; background-color: #FFFFFF; color: #000000;\" yahoofix = \"true\">
                       <center class = \"wrapper\">
                       <div class = \"webkit\">
                        <table bgcolor = \"#FFFFFF\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"wrapper\" width = \"100%\">
                        <tbody>
                            <tr>
                                <td bgcolor = \"#FFFFFF\" valign = \"top\" width = \"100%\"><!--[if (gte mso 9)|(IE)]>
                                <table width = \"600\" align = \"center\" cellpadding = \"0\" cellspacing = \"0\" border = \"0\">
                                <tr>
                                <td>
                                <![endif] -->
                                    <table align = \"center\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"outer\" data-attributes = \"%7B%22dropped%22%3Atrue%2C%22containerpadding%22%3A%220%2C0%2C0%2C0%22%2C%22containerwidth%22%3A600%2C%22containerbackground%22%3A%22%23FFFFFF%22%7D\" role = \"content-container\" width = \"100%\">
                                        <tbody>
                                            <tr>
                                                <td width = \"100%\">
                                                    <table border = \"0\" cellpadding = \"0\" cellspacing = \"0\" width = \"100%\">
                                                        <tbody>
                                                            <tr>
                                                                <td><!--[if (gte mso 9)|(IE)]>
                                                                <table width = \"600\" align = \"center\" cellpadding = \"0\" cellspacing = \"0\" border = \"0\">
                                                                <tr>
                                                                <td>
                                                                <![endif] -->
                                                                    <table align = \"center\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" style = \"width: 100%; max-width:600px;\" width = \"100%\">
                                                                           <tbody>
                                                                            <tr>
                                                                                <td align = \"left\" bgcolor = \"#FFFFFF\" role = \"modules-container\" style = \"padding: 0px 0px 0px 0px; color: #000000; text-align: left;\" width = \"100%\">
                                                                                    <table align = \"center\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"module preheader preheader-hide\" data-type = \"preheader\" role = \"module\" style = \"display:none !important; visibility:hidden; opacity:0; color:transparent; height:0; width:0;\" width = \"100%\">
                                                                                       <tbody>
                                                                                            <tr>
                                                                                                <td role = \"module-content\">
                                                                                                    <p>&nbsp;
                                                                                                    </p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <table border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"module\" data-attributes = \"%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D\" data-type = \"text\" role = \"module\" style = \"table-layout: fixed;\" width = \"100%\">
                                                                                           <tbody>
                                                                                            <tr>
                                                                                                <td bgcolor = \"#ffffff\" height = \"100%\" role = \"module-content\" style = \"padding: 0px 0px 0px 0px;\" valign = \"top\">
                                                                                                    <h1 style = \"text-align: center;\"><span style = \"font-family:lucida sans unicode,lucida grande,sans-serif;\">Welcome to CirqlHR!</span></h1>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <table align = \"center\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"wrapper\" data-attributes = \"%7B%22child%22%3Afalse%2C%22link%22%3A%22%22%2C%22width%22%3A%2286%22%2C%22height%22%3A%2286%22%2C%22imagebackground%22%3A%22%23FFFFFF%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/c36794c2bf0807db1235001886021c697a0f867e03707fe0edb5c3f46090eddc6530eabf5a08b1e6469707313ba494971b5d067a43dfdc46bc5964ef9a42c461.png%22%2C%22alt_text%22%3A%22CIRQULHR%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%220%2C0%2C0%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D\" data-type = \"image\" role = \"module\" style = \"table-layout: fixed;\" width = \"100%\">
                                                                                           <tbody>
                                                                                            <tr>
                                                                                                <td align = \"center\" role = \"module-content\" style = \"font-size:6px;line-height:10px;background-color:#FFFFFF;padding: 0px 0px 0px 0px;\" valign = \"top\"><!--[if mso]>
                                                                                                <center>
                                                                                                <table width = \"86\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" style = \"table-layout: fixed;\">
                                                                                                <tr>
                                                                                                <td width = \"86\" valign = \"top\">
                                                                                                <![endif] --><span class = \"sg-image\" data-imagelibrary = \"%7B%22width%22%3A%2286%22%2C%22height%22%3A86%2C%22alt_text%22%3A%22CIRQULHR%22%2C%22alignment%22%3A%22%22%2C%22border%22%3A0%2C%22src%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/c36794c2bf0807db1235001886021c697a0f867e03707fe0edb5c3f46090eddc6530eabf5a08b1e6469707313ba494971b5d067a43dfdc46bc5964ef9a42c461.png%22%2C%22classes%22%3A%7B%22sg-image%22%3A1%7D%7D\"><img alt = \"CIRQULHR\" border = \"0\" class = \"max-width\" height = \"86\" src = \"https://marketing-image-production.s3.amazonaws.com/uploads/c36794c2bf0807db1235001886021c697a0f867e03707fe0edb5c3f46090eddc6530eabf5a08b1e6469707313ba494971b5d067a43dfdc46bc5964ef9a42c461.png\" style = \"color: rgb(0, 0, 0); text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; max-width: 86px !important; width: 86px; height: 86px;\" width = \"86\" /></span> <!--[if mso]>
                                                                                                </td></tr></table>
                                                                                                </center>
                                                                                                <![endif] --></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <table border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"module\" data-attributes = \"%7B%22dropped%22%3Atrue%2C%22borderradius%22%3A6%2C%22buttonpadding%22%3A%2212%2C18%2C12%2C18%22%2C%22text%22%3A%22CLICK%2520HERE%2520TO%2520SIGN%22%2C%22alignment%22%3A%22center%22%2C%22fontsize%22%3A16%2C%22url%22%3A%22%22%2C%22height%22%3A%22%22%2C%22width%22%3A%22%22%2C%22containerbackground%22%3A%22%23ffffff%22%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22buttoncolor%22%3A%22%231188e6%22%2C%22textcolor%22%3A%22%23ffffff%22%2C%22bordercolor%22%3A%22%231288e5%22%7D\" data-type = \"button\" role = \"module\" style = \"table-layout: fixed;\" width = \"100%\">
                                                                                           <tbody>
                                                                                            <tr>
                                                                                                <td align = \"center\" bgcolor = \"#ffffff\" style = \"padding: 0px 0px 0px 0px;\">
                                                                                                    <table border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"wrapper-mobile\">
                                                                                                        <tbody>
                                                                                                            <tr>
                                                                                                                <td align = \"center\" bgcolor = \"#1188e6\" style = \"-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; font-size: 16px;\"><a class = \"bulletproof-button\" href = \"https://simple-php-example.herokuapp.com/reviewdocument.php?signature_id=$signature_id\"  style = \"height: px; width: px; font-size: 16px; line-height: px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 12px 18px 12px 18px; text-decoration: none; color: #ffffff; text-decoration: none; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border: 1px solid #1288e5; display: inline-block;\">CLICK HERE TO SIGN</a></td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>

                                                                                    <table align = \"center\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"module footer\" data-attributes = \"%7B%22dropped%22%3Atrue%2C%22columns%22%3A1%2C%22padding%22%3A%2210%2C5%2C10%2C5%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D\" data-type = \"footer\" role = \"module\" width = \"100%\">
                                                                                           <tbody>
                                                                                            <tr>
                                                                                                <td bgcolor = \"#ffffff\" style = \"padding: 10px 5px 10px 5px;\">
                                                                                                    <table align = \"center\" border = \"0\" cellpadding = \"0\" cellspacing = \"0\" width = \"100%\">
                                                                                                        <tbody>
                                                                                                            <tr role = \"module-content\">
                                                                                                                <td align = \"center\" class = \"templateColumnContainer\" height = \"100%\" valign = \"top\" width = \"100%\">
                                                                                                                    <table border = \"0\" cellpadding = \"0\" cellspacing = \"0\" height = \"100%\" width = \"100%\">
                                                                                                                        <tbody>
                                                                                                                            <tr>
                                                                                                                                <td class = \"leftColumnContent\" height = \"100%\" role = \"column-one\" style = \"height:100%;\">
                                                                                                                                    <table border = \"0\" cellpadding = \"0\" cellspacing = \"0\" class = \"module\" data-attributes = \"%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D\" data-type = \"text\" role = \"module\" style = \"table-layout: fixed;\" width = \"100%\">
                                                                                                                                           <tbody>
                                                                                                                                            <tr>
                                                                                                                                                <td bgcolor = \"#ffffff\" height = \"100%\" role = \"module-content\" style = \"padding: 0px 0px 0px 0px;\" valign = \"top\">
                                                                                                                                                    <div style = \"font-size:12px;line-height:150%;margin:0;text-align:center;\">This email was sent by: CirqlHR 944 Market St, Suite 500, San Francisco CA 94102 - Powered by alex@hellosign.com</div>

                                                                                                                                                    <div style = \"font-size:12px;line-height:150%;margin:0;text-align:center;\">To unsubscribe click: <a href = \"comingsoon\">here</a></div>
                                                                                                                                                </td>
                                                                                                                                            </tr>
                                                                                                                                        </tbody>
                                                                                                                                    </table>
                                                                                                                                </td>
                                                                                                                            </tr>
                                                                                                                        </tbody>
                                                                                                                    </table>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <!--[if (gte mso 9)|(IE)]>
                                                                    </td>
                                                                    </td>
                                                                    </table>
                                                                    <![endif] --></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--[if (gte mso 9)|(IE)]>
                                    </td>
                                    </tr>
                                    </table>
                                    <![endif] --></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </center>
        </body>
    </html>");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $sg = new \SendGrid($sendgrid_api_key);

        $response = $sg->client->mail()->send()->post($mail);
        echo $response->statusCode();
        echo $response->headers();
        echo $response->body();
        echo '<br />';
        echo '<a href="index.php">Click here to go home</a>';

        skip:
        // skip loop so this doesn't run when skip isn't used
        if ($uploadOk === 0) {
            echo '<br />';
            echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
        }
        ?>
    </body>
</html>
