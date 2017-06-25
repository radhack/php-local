<?php
        if (isset($check_for_callback) || $check_for_callback == 1){
            $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            retry:
            $link1 = mysqli_query($conn, "SELECT event_sent_bool FROM signatureId WHERE signature_id = '$signature_id'");
            $row = mysqli_fetch_array($link1);
//            print_r($row['event_sent_bool']);
            if ($row['event_sent_bool'] == 0){
                sleep(1);
                goto retry;
                echo "sleeping 1<br />";
            } else {
                echo "<h1>SHIT'S WORKING YO</h1>";                
            }
        }
        ?>
<!--        <div class="comment-form-comment" id="hsembedded">
            <script type="text/javascript">
            <script>
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
                        
                        if (eventData.signature_id == null) {
                            alert("SIGNATURE_ID MISSING");
                        }
                        
                        if (eventData.signature_request_id == null) {
                            alert("SIGNATURE_REQUEST_ID MISSING");
                        }

                        if (eventData.event == HelloSign.EVENT_SIGNED) {
                            HelloSign.close();
                            console.log(eventData.signature_id) + "this is the signature_id";
                            <?php unset($_SESSION['signature_id']);?>
                            window.location = "index.php";
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
        </div>-->
