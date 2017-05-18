<?php

require_once 'vendor/autoload.php';
//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["uploadedTemplateFile"]["name"]);
//$uploadOk = 1; //this is used if the other if statements are used
//$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//// doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, xlsx, txt, html, gif
//if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "ppsx" && $imageFileType != "ppt" && $imageFileType != "pptx" && $imageFileType != "tif" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "txt" && $imageFileType != "html" && $imageFileType != "gif") {
//    echo "Sorry, only doc, docx, pdf, ppsx, ppt, pptx, tif, jpg, jpeg, png, xls, <br />"
//    . "xlsx, txt, html, and gif are allowed at this point <br />";
//    $uploadOk = 0;
//}
//// Check if $uploadOk is set to 0 by an error
//if ($uploadOk == 0) {
//    echo "Sorry, your file was not uploaded.";
//    goto skip;
//// if everything is ok, try to upload file
//} else {
//    if (move_uploaded_file($_FILES["uploadedTemplateFile"]["tmp_name"], $target_file)) {
//        echo "The file " . basename($_FILES["uploadedTemplateFile"]["name"]) . " has been uploaded.";
//    } else {
//        echo "Sorry, there was an error uploading your file. <br />";
//        $uploadOk = 0;
//        goto skip;
//    }
//}
// Get your credentials from environment variables
$api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';
$client_id = getenv('HS_CLIENT_ID_LOCAL') ? getenv('HS_CLIENT_ID_LOCAL') : '';

$client = new HelloSign\Client($api_key);
$request = new HelloSign\TemplateSignatureRequest();
$request->enableTestMode();
$request->setClientId($client_id);
$templateid = "5f15711bf170531c5336528a1a4cbad2bd10da41";
$request->setTemplateId($templateid);
$request->setTitle('Test Title');
$request->setSubject('Test Subject');
$request->setMessage('Test Message');
$request->setSigner('Role1', 'alex+test@hellosign.com', 'Alex');
$request->setCustomFieldValue("Cost", "20k");

$response = $client->sendTemplateSignatureRequest($request);

$new_template_id = $response->getId(); //not really using this right now
$templatefields = $client->getTemplate($templateid);
echo count($response->custom_fields);
echo '<br />';
echo count($templatefields->custom_fields);

echo '<br />';
echo '<a href="index.php">GO HOME YOU ARE DRUNK</a>';
?>