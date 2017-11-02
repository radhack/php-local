<!DOCTYPE html>
<html>
    <head>
        <title>Embedded Template Editing</title>
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
        
        $api_key = getenv('HS_APIKEY_PROD') ? getenv('HS_APIKEY_PROD') : '';

        $template_id = $params['template_id'];
        $tmp_file_path = $params['tmp_file_path'];
        $url = static::TEMPLATE_PATH . '/update_files/' . $template_id;
        $update_files_params = array(
        'template_id' => $template_id,
        'file' => array(
        "@" . $tmp_file_path
        )
        );

        try {
        $response = $this->rest->post($url, $update_files_params);
        } catch (Exception $e) {
        dump("HS:Client:updateTemplateFiles: Exception caught when POST to HS", $e->getMessage());
        }
        dump("HS:Client:updateTemplateFiles:", "url=$url", "params=", $update_files_params, "response=", $response);

        $this->checkResponse($response);

        $new_template_id = $response->template->template_id;

        return($new_template_id);
        }
