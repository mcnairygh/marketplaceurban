<?php
 // Retrieve Business Listings
  
 include("../include/config.php");
 
    $sql = "SELECT * FROM tbllistings WHERE bstatus != 0 ORDER BY bcategory ASC  ";
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
    
        $returndata[] = array("id" => $id,
                    "lname" => $bname,
                    "ltype" => $btype,
                    "lcategory" => $bcategory,
                    "ldescription" => $bdescription,
                    "lcity" => $bcity,
                    "lstate" => $bstate,
                    "lwebsite" => $bwebsite,
                     "llogo" => $blogo
                    );
    }

    
} else {
    $returndata [] = array("id" => 0,
                    "lname" => 'No Listing Found',
                    "ltype" => ' ',
                    "lcategory" => ' ',
                    "ldescription" => ' ',
                    "lcity" => ' ',
                    "lstate" => ' ',
                    "lwebsite" => ' ',
                    "llogo" => ' '
                    );
}
$db->close();
    echo  json_encode($returndata);
    
?>