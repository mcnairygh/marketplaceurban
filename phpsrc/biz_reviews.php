<?php
 // Retrieve Business Listings
 $sid = 0;
 $searchid = $_GET["bizid"]; 
 $sid = $searchid;
 
    //echo $searchid;
 include("../include/config.php");
    
     
    
    
    $sql = "SELECT * FROM tblreviews WHERE rbid = '$sid' ORDER BY rbdate LIMIT 5";
    $i = 0;
    $result = $db->query($sql);
  
    if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
        $id = $row['rbid'];
        $rbreview = $row['rbreview'];
        $rbcustomer = $row['rbcustomer'];
        
        $returndata[] = array("id" => $id,
                    "rbreview" => $rbreview,
                    "rbcustomer" => $rbcustomer
                    );
    }

    
} else {
    $returndata [] = array("id" => 0,
                    "rbreview" => 'No Reviews',
                    "rbcustomer" => ' ',
                    );
}
$db->close();
    echo  json_encode($returndata);
    
?>