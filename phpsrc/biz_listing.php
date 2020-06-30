<?php
 // Retrieve Business Listings
 $sid = 0;
 $searchid = $_GET["bizid"]; 
 $sid = $searchid;
 
    //echo $searchid;
 include("../include/config.php");
 
    $sql = "SELECT * FROM tbllistings WHERE id = '$sid' ";
    $i = 0;
    $result = $db->query($sql);
  
    if ($result->num_rows > 0) {
        // output data of each row
        
        while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $bname = $row['bname'];
        $btype = $row['btype'];
        $bcategory = $row['bcategory'];
        $bdescription = $row['bdescription'];
        $bcity = $row['bcity'];
        $bstate = $row['bstate'];
        $bwebsite = $row['bwebsite'];
        $blogo = $row['blogo'];
        $brate = $row['brate'];
    
        $returndata[] = array("id" => $id,
                    "bname" => $bname,
                    "btype" => $btype,
                    "bcategory" => $bcategory,
                    "bdescription" => $bdescription,
                    "bcity" => $bcity,
                    "bstate" => $bstate,
                    "bwebsite" => $bwebsite,
                     "blogo" => $blogo,
                     "brate" => $brate
                    );
    }

    
} else {
    $returndata [] = array("id" => 0,
                    "bname" => 'No Listing Found',
                    "btype" => ' ',
                    "bcategory" => ' ',
                    "bdescription" => ' ',
                    "bcity" => ' ',
                    "bstate" => ' ',
                    "bwebsite" => ' ',
                    "blogo" => ' '
                    );
}
$db->close();
    echo  json_encode($returndata);
    
?>