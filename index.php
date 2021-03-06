<?php
include('auth.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>HelloSign API with PHP</title>
        <link rel="stylesheet" type="text/css" href="newcss.css" />
        <style type="text/css">
            body {
                background-color: #aaa;
                margin: 0;
                padding: 0;

            }
            div {
                width: 815px;
                margin: 5em auto;
                padding: 10px;
                background-color: #f0f0f2;
                border-radius: 1em;
                box-shadow: 1px 1px 1px #00B3E6;
            }
            @media (max-width: 800px) {
                body {
                    background-color: #fff;
                }
                div {
                    width: auto;
                    margin: 0 auto;
                    border-radius: 0;
                    padding: 0px;
                }
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- <script type='text/javascript' src="https://cdn.rawgit.com/jamesallardice/Placeholders.js/master/dist/placeholders.min.js"></script> -->
    </head>
    <body>
        <?php
        require_once 'vendor/autoload.php';
        if (isset($_SESSION['fromEmbeddedRequesting']) && $_SESSION['fromEmbeddedRequesting'] == true) {
            $client = new HelloSign\Client($api_key);
            $signature_request_object = $client->getSignatureRequest($_SESSION['signature_request_id']);
//            print_r(json_encode($signature_request_object->toArray()));
            include('db.php');
            $_SESSION['fromEmbeddedRequesting'] = false;
        }
        
        // no longer using LaunchDarkly
        // $user = new LaunchDarkly\LDUser(hash("md5", time()));
        // the selector will match all input controls of type :checkbox
        // and attach a click event handler 
//        $user = new LaunchDarkly\LDUser("herp@derping.com");
//        if ($ld_client->variation("show-name-and-email", $user)) {
        
        if (1 == 0) { //invalidate if you want to remove the requirement for name and email
            ?>
            <div class="entry-content">
                <h1>HelloWorks is here at last!</h1>
                <!-- this is creating an embedded signature request using text tags -->
                <form action="/helloworks.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <p>Enter your name and email address here to try out the OneLogic Test flow</p>
                        <p><small>Please use false information - this is for demo purposes only</small></p>
                        <input type="text" name="hw_name" id="hw_name" placeholder="First and Last Name" required/>
                        <br />
                        <input type="email" name="hw_email" id="hw_email" placeholder="Email Address" required/>
                        <!--<br />-->
                        <!--Choose either to receive a link, or a code, in the verification email from HelloWorks-->
                        <!--<br />-->
                        <!--<input type="checkbox" value="1" name="checkbox[1][]" id="hw_send_link" checked/> Link (default for now)-->
                        <!--<br />-->
                        <!--<input type="checkbox" value="1" name="checkbox[1][]" id="hw_send_code"/> Code-->
                        <br />
                        <input type="submit" value="Fill out a W-9"/>
                        <!--<br />-->
<!--                        <script>
                            $("input:checkbox").on('click', function () {
                                // in the handler, 'this' refers to the box clicked on
                                var $box = $(this);
                                if ($box.is(":checked")) {
                                    // the name of the box is retrieved using the .attr() method
                                    // as it is assumed and expected to be immutable
                                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                                    // the checked state of the group/box on the other hand will change
                                    // and the current value is retrieved using .prop() method
                                    $(group).prop("checked", false);
                                    $box.prop("checked", true);
                                } else {
                                    $box.prop("checked", false);
                                }
                            });</script>-->
                    </fieldset>
                </form>
                <br />
                <h1>Have a look at these <i>awesome</i> embedded examples!</h1>
                <h2> These are mobile or pc friendly</h2>
                <!-- this is creating an embedded signature request using text tags -->
                <form action="/signatureRequestTextTags.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <input type ="text" name="signername" id="signername" placeholder="First and Last Name" required/>
                        <br />
                        <input type="email" name="signeremail" id="signeremail" placeholder="Email Address" required/>
                        <br />
                        <input type="submit" value="Text Tags are cool"/>
                        <br />
                        <input type="file" name="uploadedTextTags" id="uploadedTextTags" required/>
                        <p>Sign a signature request that uses text tags</p>
                        <p>NOTE - use a text tags pdf with only <b>one</b> signer!</p>
                    </fieldset>
                </form>

                <!-- this is a standard sig request with an appended signature page -->
                <form action="/AppendedSignaturePage.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <br />
                        <input type ="text" name="signername" id="signername" placeholder="First and Last Name" required/>
                        <br />
                        <input type="email" name="signeremail" id="signeremail" placeholder="Email Address" required/>
                        <br />
                        <input type="submit" value="Easy as easy gets"/>
                        <br />
                        <input type="file" name="uploadedfile" id="uploadedfile" required/>
                        <br />
                        <p>Sign a signature request that uses an appended signature page</p>
                    </fieldset>
                </form>

                <!-- this is a standard sig request with an appended signature page which triggers an email -->
                <form action="/AppendedSignaturePage_email.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <br />
                        <input type ="text" name="signername" id="signername" placeholder="First and Last Name" required/>
                        <br />
                        <input type="email" name="signeremail" id="signeremail" placeholder="Email Address" required/>
                        <br />
                        <input type="submit" value="Easy as easy gets with email"/>
                        <br /> 
                        <input type="file" name="uploadedfile" id="uploadedfile" required/>
                        <br />
                        <p>Sign a signature request that uses an appended signature page, and triggers an email to the signer</p>
                    </fieldset>
                </form>

                <!-- this for embedded signing with template -->
                <form action="/signatureRequestFormFields.php">
                    <fieldset>
                        <br />
                        <input type ="text" name="signername" id="signername" placeholder="First and Last Name" required/>
                        <br />
                        <input type="email" name="signeremail" id="signeremail" placeholder="Email Address" required/>
                        <br />
                        <input type="submit" value="Embedded Signature With Form Fields"/>
                        <br />
                    </fieldset> 
                    <p>This uses form_fields_per_document and it's hardcoded, but you're welcome to check it out!<br /></p>
                </form>

                <!-- this for embedded signing with template -->
                <form action="/signatureRequestWithTemplate.php">
                    <fieldset>
                        <br />
                        <input type ="text" name="signername" id="signername" placeholder="First and Last Name" pattern="^([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]*)+[ ]([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]+)+$" title="First and Last Name" required/>
                        <br />
                        <input type="email" name="signeremail" id="signeremail" placeholder="Email Address" required/>
                        <br />
                        <input type="submit" value="Embedded Signature With Template"/>
                        <br />
                    </fieldset> 
                    <p>The template's hardcoded and setup to trigger a specific response<br /></p>
                    <p>but you're welcome to check the template out!<br /></p>
                </form>

                <h2>These are only pc friendly</h2>

                <!-- this is an embedded template page -->
                <form action="/embeddedTemplate.php" method="post" enctype="multipart/form-data">        
                    <fieldset>
                        <input type="submit" value="Template Creation"/>
                        <br />
                        <input type="file" name="uploadedTemplateFile" id="uploadedTemplateFile"/>
                        <p>Create a template</p>
                    </fieldset>
                </form>

                <!-- this is an edit template files page -->
                <form action="/updateTemplateFiles.php" method="post" enctype="multipart/form-data">        
                    <fieldset>
                        <br />
                        <input type="text" name="template_id" id="template_id"/>
                        <br />
                        <input type="file" name="newUploadedTemplateFile" id="newUploadedTemplateFile"/>
                        <input type="submit" value="Update Template Files"/>
                        <p>Update Template Files</p>
                    </fieldset>
                </form>
                
                <!-- this is an edit embedded template page -->
                <form action="/editEmbeddedTemplate.php" method="post" enctype="multipart/form-data">        
                    <fieldset>
                        <br />
                        <input type="text" name="templateID" id="templateID"/>
                        <br />
                        <input type="submit" value="Edit An Embedded Template"/>
                        <p>Edit an embedded template</p>
                    </fieldset>
                </form>

                <!-- this is an embedded requesting page -->
                <form action="/embeddedRequesting.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <br />
                        <input type="submit" value="Requesting"/>
                        <br />
                        <input type="file" name="requestingFile" id="requestingFile"/>
                    </fieldset>
                    <p>Create a signature request that will send a HelloSign email to the signer(s)</p>
                </form>
                
                        <!-- this is an unclaimed draft requesting - hellosign.com login required to "claim" -->
                <form action="/unclaimedDraft.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <br />
                        <input type="submit" value="Unclaimed Draft Requesting"/>
                        <br />
                        <input type="file" name="unclaimedDraftFile" id="unclaimedDraftFile"/>
                    </fieldset>            
                    <p>Create a Draft to be claimed by someone with a HelloSign.com Account</p>
                </form>

                <!-- this is an embedded requesting page with embedded signing -->
                <form action="/embeddedRequestingEmbeddedSigning.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <br />
                        <input type="submit" value="Requesting for Embedded Signing"/>
                        <br />
                        <input type="file" name="requestingFileEmbSig" id="requestingFileEmbSig"/>
                    </fieldset>            
                    <p>Create a signature request that will be used for embedded signing</p>
                </form>

                <!-- this for testing bugs -->
                <form action="/bugstesting.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <br />
                        <input type="submit" value="Bug Testing Only"/>
                        <br />
                        <input type="file" name="BugTestingOnly" id="BugTestingOnly"/>
                    </fieldset> 
                    <p>Use For Bug Testing Only - setup for bug</p>
                </form>
            </div>
            <br /><br /><a href="privacypolicy.htm" style="color: #555">Privacy Policy</a>
            <p><small>Thanks for playing!</small></p>
        </body>
    </html>
    <?php
} else {
    ?>
    <div class="entry-content">
        <h1>HelloWorks is here at last!</h1>
        <!-- this is creating an embedded signature request using text tags -->
        <form action="/helloworks.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <p>Enter your name and email address here to try out the W-9 flow</p>
                <p><small>Please use false information - this is for demo purposes only</small></p>
                <input type="text" name="hw_name" id="hw_name" placeholder="First and Last Name" required/>
                <br />
                <input type="email" name="hw_email" id="hw_email" placeholder="Email Address" required/>
                <br />
                <input type="submit" value="Fill out a W-9"/>
                <br />
            </fieldset>
        </form>
        <br />
        <h1>Have a look at these <i>awesome</i> embedded examples!</h1>
        <h2> These are mobile or pc friendly</h2>
        <!-- this is creating an embedded signature request using text tags -->
        <form action="/signatureRequestTextTags.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <input type="submit" value="Text Tags are cool"/>
                <br />
                <input type="file" name="uploadedTextTags" id="uploadedTextTags" required/>
                <p>Sign a signature request that uses text tags</p>
                <p>NOTE - use a text tags pdf with only <b>one</b> signer!</p>
            </fieldset>
        </form>

        <!-- this is a standard sig request with an appended signature page -->
        <form action="/AppendedSignaturePage.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <br />
                <input type="submit" value="Easy as easy gets"/>
                <br />
                <input type="file" name="uploadedfile" id="uploadedfile" required/>
                <br />
                <p>Sign a signature request that uses an appended signature page</p>
            </fieldset>
        </form>

        <!-- this is a standard sig request with an appended signature page which triggers an email -->
        <form action="/AppendedSignaturePage_email.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <br />
                <input type ="text" name="signername" id="signername" placeholder="First and Last Name" required/>
                <br />
                <input type="email" name="signeremail" id="signeremail" placeholder="Email Address" required/>
                <br />
                <input type="submit" value="Easy as easy gets with email"/>
                <br /> 
                <input type="file" name="uploadedfile" id="uploadedfile" required/>
                <br />
                <p>Sign a signature request that uses an appended signature page, and triggers an email to the signer</p>
            </fieldset>
        </form>

        <!-- this for embedded signing with template -->
        <form action="/signatureRequestFormFields.php">
            <fieldset>
                <br />
                <input type="submit" value="Embedded Signature With Form Fields"/>
                <br />
            </fieldset> 
            <p>This uses form_fields_per_document and it's hardcoded, but you're welcome to check it out!<br /></p>
        </form>

        <!-- this for embedded signing with template -->
        <form action="/signatureRequestWithTemplate.php">
            <fieldset>
                <br />
                <input type="submit" value="Embedded Signature With Template"/>
                <br />
            </fieldset> 
            <p>The template's hardcoded and setup to trigger a specific response<br /></p>
            <p>but you're welcome to check the template out!<br /></p>
        </form>

        <h2>These are only pc friendly</h2>

        <!-- this is an embedded template page -->
        <form action="/embeddedTemplate.php" method="post" enctype="multipart/form-data">        
            <fieldset>
                <input type="submit" value="Template Creation"/>
                <br />
                <input type="file" name="uploadedTemplateFile" id="uploadedTemplateFile"/>
                <p>Create a template</p>
            </fieldset>
        </form>
        
        <!-- this is an edit template files page -->
                <form action="/updateTemplateFiles.php" method="post" enctype="multipart/form-data">        
                    <fieldset>
                        <br />
                        <input type="text" name="template_id" id="template_id" placeholder="Template ID" required="true"/>
                        <br />
                        <input type="file" name="newUploadedTemplateFile" id="newUploadedTemplateFile" required="true"/>
                        <br />
                        <input type="submit" value="Update Template Files"/>
                        <p>Update Template Files</p>
                    </fieldset>
                </form>

        <!-- this is an edit embedded template page -->
        <form action="/editEmbeddedTemplate.php" method="post" enctype="multipart/form-data">        
            <fieldset>
                <br />
                <input type="text" name="templateID" id="templateID" placeholder="Template ID" required="true"/>
                <br />
                <input type="submit" value="Edit An Embedded Template"/>
                <p>Edit an embedded template</p>
            </fieldset>
        </form>

        <!-- this is an embedded requesting page -->
        <form action="/embeddedRequesting.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <br />
                <input type="submit" value="Requesting"/>
                <br />
                <input type="file" name="requestingFile" id="requestingFile" required="true"/>
            </fieldset>
            <p>Create a signature request that will send a HelloSign email to the signer(s)</p>
        </form>

        <!-- this is an embedded requesting page with embedded signing -->
        <form action="/embeddedRequestingEmbeddedSigning.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <br />
                <input type="submit" value="Requesting for Embedded Signing"/>
                <br />
                <input type="file" name="requestingFileEmbSig" id="requestingFileEmbSig"/>
            </fieldset>            
            <p>Create a signature request that will be used for embedded signing</p>
        </form>
        
        <!-- this is an unclaimed draft requesting - hellosign.com login required to "claim" -->
        <form action="/unclaimedDraft.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <br />
                <input type="submit" value="Unclaimed Draft Requesting"/>
                <br />
                <input type="file" name="unclaimedDraftFile" id="unclaimedDraftFile"/>
            </fieldset>            
            <p>Create a Draft to be claimed by someone with a HelloSign.com Account</p>
        </form>

        <!-- this for testing bugs -->
        <form action="/bugstesting.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <br />
                <input type="submit" value="Bug Testing Only"/>
                <br />
                <input type="file" name="BugTestingOnly" id="BugTestingOnly"/>
            </fieldset> 
            <p>Use For Bug Testing Only - setup for bug</p>
        </form>
    </div>
    <br /><br /><a href="privacypolicy.htm" style="color: #555">Privacy Policy</a>
    <p><small>Thanks for playing!</small></p>
    </body>
    </html>
    <?php
}