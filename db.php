<?php

/*
 * Copyright (C) 2017 alexgriffen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//this connection broke until I setup the symbolic link in /var/mysql
//as per Brian Lowe's answer here: https://stackoverflow.com/questions/4219970/warning-mysql-connect-2002-no-such-file-or-directory-trying-to-connect-vi

$dbadmin = getenv('DB_ADMIN');
$dbpassword = getenv('DB_PASSWORD');
$servername = "localhost";
$dbname = "testdb";
$time = time();

if (isset($signature_request_id)) {

    // Create connection to save to sigantureRequest table
    $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($signer_email)) {
        $sql = "INSERT INTO signatureRequest VALUES('$signature_request_id','$createdHow','$signer_email','$time')";
    } else {
        $sql = "INSERT INTO signatureRequest VALUES('$signature_request_id','$createdHow',NULL,'$time')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "INSERT INTO signatureRequest testdb successfull";
    } else {
        echo "<br />Error INSERTing (lol): " . $conn->error;
    }

    // Create connection to save to sigantureId table
    if (isset($signature_id)) {

        $conn1 = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
        // Check connection
        if ($conn1->connect_error) {
            die("Connection failed: " . $conn1->connect_error);
        }

        $sql = "INSERT INTO signatureId VALUES('$signature_request_id','$signature_id','$event_sent_bool')";

        if ($conn1->query($sql) === TRUE) {
            echo "INSERT INTO signatureId testdb successfull";
        } else {
            echo "<br />Error INSERTing (lol): " . $conn1->error;
        }
    }
} elseif (isset($template_id)) {

    // Create connection
    $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO template VALUES('$template_id','$createdHow','$time')";

    if ($conn->query($sql) === TRUE) {
        echo "INSERT to testdb successfull";
    } else {
        echo "<br />Error INSERTing (lol): " . $conn->error;
    }
} elseif (isset($_SESSION['fromEmbeddedRequesting']) && $_SESSION['fromEmbeddedRequesting'] == true) {

    // Create connection
    $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $converted = json_encode($signature_request_object->toArray());
    $signature_request_id = $_SESSION['signature_request_id'];

    $sql = "INSERT INTO signatureRequestJson VALUES('$signature_request_id','embeddedRequesting','$converted')";

    if ($conn->query($sql) === TRUE) {
        echo "INSERT to testdb successfull";
    } else {
        echo "<br />Error INSERTing (lol): " . $conn->error;
    }
} elseif (isset($hw_email)) {

    // Create connection
    $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO helloWorks VALUES('$hw_instance_id','$hw_name','$hw_email','$hw_sign_url')";

    if ($conn->query($sql) === TRUE) {
        echo "INSERT to helloWorks successfull";
    } else {
        echo "<br />Error INSERTing (lol): " . $conn->error;
    }
//    TODO - setup callback server to save state of request
//    if same signer comes back to HelloWorks, serve same hw_sign_url
} elseif ($is_loop_time == 1) {

    // Create connection to save to sigantureRequest table
    $conn = new mysqli($servername, $dbadmin, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT signature_request_id FROM signatureRequest";

    $result = mysqli_query($conn, $sql);
        
    $num_rows = mysqli_num_rows($result);
    echo "$num_rows is the number of rows <br />";
        $client = new HelloSign\Client($api_key);

    while ($signature_request_id_row = mysqli_fetch_array($result)) {
        try {
        $client->getFiles($signature_request_id_row['signature_request_id'], "downloaded_files/" . $signature_request_id_row['signature_request_id'] . ".pdf", HelloSign\SignatureRequest::FILE_TYPE_PDF);
        } catch (HelloSign\Error $e) {
            print_r($e);
            echo "<br />";
        }
    }
    echo "done with while loop";
}

//$conn->close();
