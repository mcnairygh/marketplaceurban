<?php 
        $servername = "bdrevents.db.2262493.hostedresource.com";
        $username = "bdrevents";
        $password = "Business17#";
        $dbname = "bdrevents";

// Create connection
        $dbCon = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($dbCon->connect_error) {
    die("Connection failed: " . $dbCon->connect_error);
    }
	
	
	?>