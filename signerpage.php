<div class="comment-form-comment" id="hsembedded">
<!--            <script type="text/javascript">-->
    <script>
        HelloSign.init("<?php echo $client_id ?>");
        HelloSign.open({
            url: "<?php echo $sign_url ?>",
            allowCancel: true,
//            skipDomainVerification: true,
            uxVersion: 2,
            debug: true,
//            userCulture: HelloSign.CULTURES.ES_MX, // Spanish Mexico
//            userCulture: HelloSign.CULTURES.FR_FR, // French
//            userCulture: HelloSign.CULTURES.SV_SE, // Swedish
//            userCulture: HelloSign.CULTURES.DE_DE, // German
//            userCulture: HelloSign.CULTURES.ZH_CN, // Chinese - NOTE: THIS DOES NOT YET SUPPORT RIGHT TO LEFT; ONLY CHARACTERS
//            userCulture: HelloSign.CULTURES.DA_DK, // Danish
//            userCulture: HelloSign.CULTURES.NL_NL, // Dutch
//            userCulture: HelloSign.CULTURES.ES_ES, // Spainsh Spain
//            userCulture: HelloSign.CULTURES.PT_BR, // Portuguese (Brazil)
//            userCulture: HelloSign.CULTURES.PL_PL, // Polish
            messageListener: function (eventData) {
                (console.log(">-*>-*>-*> Got message data: " + JSON.stringify(eventData)));
                if (eventData.event == HelloSign.EVENT_SIGNED) {
                    if (eventData.signature_id == null) {
                        alert("SIGNATURE_ID MISSING");
                    }
                    HelloSign.close();
                    window.location.href = 'http://www.google.com';
                    alert("Give me a few seconds to get the documents");
                    console.log(eventData.signature_id + " here's some information that's useful...*&^^&**&^^&**&^^&**&^^&*");
//                  console.log("This is the signature_request_id...");
                    <?php // unset($_SESSION['signature_id']); ?>;          
                } else if (eventData.event == HelloSign.EVENT_CANCELED) {
                    HelloSign.close();
                    console.log(eventData);
                } else if (eventData.event == HelloSign.EVENT_ERROR) {
//                    HelloSign.close();
                    var error = eventData.description;
                    alert(error);
                    console.log(eventData);
                } else if (eventData.event == HelloSign.EVENT_SENT) {
                    if (eventData.signature_request_id == null) {
                        alert("SIGNATURE_REQUEST_ID MISSING");
                    }
                    HelloSign.close();
                    console.log(eventData);
                    console.log("************");
                    console.log(eventData.signature_request_id);
                } else if (eventData.event == HelloSign.EVENT_TEMPLATE_CREATED) {
                    HelloSign.close();
                    var template_id = eventData.template_id;
                    //                            window.alert("Template ID is " + template_id);
                    console.log(eventData);
                } else if (eventData.event == HelloSign.EVENT_DECLINED) {
                    HelloSign.close();
                    //                            alert("Signature Request declined And Stuff!");
                    console.log(eventData);
                }
            }
        });
    </script>
    Click the button below to view your documents. Otherwise, click <a href="index.php">here</a> to go home.<br />
        <button onclick="getDocuments();">Click to see if documents are ready</button>
    <script>
        function getDocuments() {
            setTimeout(function(){window.location = "getDocs.php?signature_request_id=<?php echo $signature_request_id?>";}, 1000);  
        }
    </script>
</div>
