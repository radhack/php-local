<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Embedded Template Creation</title>
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

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["uploadedTemplateFile"]["name"]);
        $uploadOk = 1; //this is used if the other if statements are used
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, xlsx, txt, html, gif
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
            if (move_uploaded_file($_FILES["uploadedTemplateFile"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["uploadedTemplateFile"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file. <br />";
                $uploadOk = 0;
                goto skip;
            }
        }

        $client = new HelloSign\Client($api_key);
        $request = new HelloSign\Template();
        $request->enableTestMode();
        $request->setClientId($client_id);
        $request->addFile("$target_file");
        $request->addFile("./nda.pdf");
//        $request->setTitle("things here are...");
        $request->setSubject("and here are other things");
        $request->setMessage("exactly what they seem");
//        $request->setTitle('Test Title');
//        $request->setSubject('Test Subject');
//        $request->setMessage('Test Message');
//$request->addSignerRole('Role0', 0);
//$request->addSignerRole('Role1', 1);
//$request->addSignerRole('Role2', 2);
//$request->addSignerRole('Role3', 3);
        $request->addSignerRole('Role0');
        $request->addSignerRole('Role1');
        $request->addSignerRole('Role2');
        $request->addSignerRole('Role3');
//$request->addCCRole('Test CC Role');
        $request->addMergeField('Test Merge', 'text');
        $request->addMergeField('Test Merge 1', 'text');
        $request->addMergeField('Test Merge 3', 'text');
        $request->addMergeField('Test Merge 4', 'text');
        $request->addMergeField('Test Merge 5', 'text');
        $request->addMergeField('Test Merge 2', 'checkbox');
//        $request->setFormFieldsPerDocument(
//                [//everything
//                    [//document 1
//                        [//component 1
//                            "api_id" => "things_1",
//                            "name" => "Test Merge",
//                            "type" => "text",
//                            "x" => 220,
//                            "y" => 85,
//                            "width" => 253,
//                            "height" => 16,
//                            "required" => true,
//                            "signer" => 0
//                        ],
//                        [//component 2
//                            "api_id" => "things_2",
//                            "name" => "Test Merge 1",
//                            "type" => "text",
//                            "x" => 530,
//                            "y" => 85,
//                            "width" => 152,
//                            "height" => 16,
//                            "required" => true,
//                            "signer" => 0
//                        ],
//                        [//component 3
//                            "api_id" => "lotsof_2",
//                            "name" => "Test Merge 3",
//                            "type" => "signature",
//                            "x" => 90,
//                            "y" => 315,
//                            "width" => 223,
//                            "height" => 30,
//                            "required" => true,
//                            "signer" => 0,
//                            "page" => 2,
//                        ]
//                    ]
//                ]
//            );

        $response = $client->createEmbeddedDraft($request);

        $template_id = $response->getId();
        $createdHow = "createEmbeddedTemplate";
        include ('db.php');
        $sign_url = $response->getEditUrl();
        $is_embedded_draft = $response->isEmbeddedDraft();

        include ('signerpage.php');

        skip:
// skip loop so this doesn't run when skip isn't used
        if ($uploadOk == 0) {
            echo '<br />';
            echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
        }
        ?>
    </body>
</html>