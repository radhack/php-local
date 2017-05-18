
        <div class="comment-form-comment" id="hsembedded">
            <script type="text/javascript">
                HelloSign.init("<?php echo $client_id ?>");
                HelloSign.open({
                    url: "<?php echo $sign_url ?>",
                    uxVersion: 2,
                    allowCancel: true,
//                    skipDomainVerification: true,
//                    container: document.getElementById('hsembedded'),
//                    test_mode : 1,
                    debug: true,
//                    hideHeader: true,
                    messageListener: function (eventData) {
                        (console.log("Got message data: " + JSON.stringify(eventData)));

                        if (eventData.event == HelloSign.EVENT_SIGNED) {
//                            HelloSign.close();
                            console.log(eventData.signature_id) + "this is the signature_id";
//                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_CANCELED) {
                            HelloSign.close();
                            alert("Event Canceled And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_ERROR) {
                            HelloSign.close();
                            alert("There Was An Error And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_SENT) {
                            HelloSign.close();
                            alert("Signature Request Sent And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_TEMPLATE_CREATED) {
                            HelloSign.close();
                            var template_id = eventData.template_id;
                            window.alert("Template ID is " + template_id);
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_DECLINED) {
                            HelloSign.close();
                            alert("Signature Request declined And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        }
                    }
                });
            </script>
        </div>
