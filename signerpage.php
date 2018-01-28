<div class="comment-form-comment" id="hsembedded">
<!--            <script type="text/javascript">-->
    <script>
//                    console.log(parent_url + " THIS IS THE PARENT_URL");
//                    console.log(window.parent.location + " is the parent.location");
        HelloSign.init("<?php echo $client_id ?>");
        HelloSign.open({
            url: "<?php echo $sign_url ?>",
            //                    uxVersion: 1,
            //                    test_mode : 1,
            //                    hideHeader: true,
            allowCancel: true,
            skipDomainVerification: true,
            uxVersion: 2,
            //                    container: document.getElementById('hsembedded'),
            debug: true,
            messageListener: function (eventData) {
                (console.log(">-*>-*>-*> Got message data: " + JSON.stringify(eventData)));
                if (eventData.event == HelloSign.EVENT_SIGNED) {
                    if (eventData.signature_id == null) {
                        alert("SIGNATURE_ID MISSING");
                    }
                    HelloSign.close();
                    alert("Give me a few seconds to get the documents");
                    console.log(eventData.signature_id + " here's some information that's useful...*&^^&**&^^&**&^^&**&^^&*");
//                  console.log("This is the signature_request_id...");
                    <?php // unset($_SESSION['signature_id']); ?>;          
//                  window.location = "index.php";
                } else if (eventData.event == HelloSign.EVENT_CANCELED) {
                    HelloSign.close();
                    //                            alert("Event Canceled And Stuff!");
                    console.log(eventData);
                    window.location = "index.php";
                } else if (eventData.event == HelloSign.EVENT_ERROR) {
                    HelloSign.close();
                    alert("There Was An Error And Stuff!");
                    console.log(eventData);
                    window.location = "index.php";
                } else if (eventData.event == HelloSign.EVENT_SENT) {
                    if (eventData.signature_request_id == null) {
                        alert("SIGNATURE_REQUEST_ID MISSING");
                    }
                    HelloSign.close();
                    //                            alert("Signature Request Sent And Stuff!");
                    console.log(eventData);
                    console.log("************");
                    console.log(eventData.signature_request_id);
                    window.location = "index.php";
                } else if (eventData.event == HelloSign.EVENT_TEMPLATE_CREATED) {
                    HelloSign.close();
                    var template_id = eventData.template_id;
                    //                            window.alert("Template ID is " + template_id);
                    console.log(eventData);
                    window.location = "index.php";
                } else if (eventData.event == HelloSign.EVENT_DECLINED) {
                    HelloSign.close();
                    //                            alert("Signature Request declined And Stuff!");
                    console.log(eventData);
                    window.location = "index.php";
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
