
        <div id="hellosign-embed">
            <script>
                HelloSign.init("<?php echo $client_id ?>");
                HelloSign.open({
                    url: "<?php echo $sign_url ?>",
                    uxVersion: 2,
                    allowCancel: true,
                    debug: true,
                    container: document.getElementById("hellosign-embed"),
                    messageListener: function (eventData) {
                        ("Got message data: " + JSON.stringify(eventData));

                        if (eventData.event == HelloSign.EVENT_SIGNED) {
                            alert("Signature Request Signed And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_CANCELED) {
                            alert("Signature Request Canceled And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_ERROR) {
                            alert("There Was An Error And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_SENT) {
                            alert("Signature Request Sent And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        } else if (eventData.event == HelloSign.EVENT_TEMPLATE_CREATED) {
                            alert("Template Created And Stuff!");
                            console.log(eventData);
                            window.location = "index.php";
                        }
                    }
                });
            </script>
        </div>
