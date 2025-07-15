<?php
require '../../../dbconnection/dbConnection.php';  
$Status_ary     = array();
$ReturnData_ary = array();
$data_ary['Data_Ary'] = array(); // initialize
//$strFuncType="funGetLineData";
//$UserPost = $_POST["userpara"];
//$strFuncType = $UserPost[0];   
$strFuncType="funGetLineData";
$IssueType=[
    "Pest Control",
    "Generator", "Chiller", "A/C", "Electrical", "Fire System", "Civil ",
    "Compressor", "Transformer", "Diesel Storage", "Civil - Plumbing",
    "Water dispenser", "Duct System", "PA System", "Lift", "EAC", "CCTV"
];
$Location=[
    "Generator Room","Chiller Room","ATS Room","Guard Room",
    "Compressor Room","100kva - Transformer Area","1500kva - Transformer Area",
    "Diesel Tank Area","Canteen ","Chill-Out","Fire System Pump Room 1","MBC - Moulding",
    "MBC-PDC","CCP-PDC","Lamination & Hot Melt Area","CNC & IM Area","CCP","5 Storey - C2 (2nd Floor)",
    "Washroom - 01 Male","Washroom - 01 Female","Washroom - 02 Male","5 Storey - Ground Floor","5 Storey - C1 ( 1st Floor)",
    "5 Storey - C3 (3rd Floor)","Training School","Stores","J Building","Advanced Assembly (G)","Sky Blue (G)",
    "MBC-Lamination","Blue Sky","CNC Workshop","Washroom - 02 Female","Lamination - Cutting","B2","Compressor 75 KW"
];


    if($strFuncType === "funGetLineData") {
      




        try{
            for($x=0;$x<count($IssueType);$x++)
            {
                $strIssueType=$IssueType[$x];

                for($i=0;$i<count($Location);$i++)
                {
                $strLocation=$Location[$i];
               $combined = $strIssueType ."_". $strLocation;

                $sqlString ="SELECT COUNT(*) as count  
                            FROM tblwo_masterdata_breakdown 
                            WHERE IssueType=:strIssueType AND Location = :strLocation;";
                //$sqlString =="SELECT count(Generator Room) FROM `tblwo_masterdata_breakdown`";
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $stmt = $conn->prepare($sqlString);
                $stmt->bindParam(':strLocation', $strLocation); 
               // $stmt->bindParam(':countName', $combined); 
                 $stmt->bindParam(':strIssueType', $strIssueType); 
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);        
                $result = $stmt->fetchAll();
                ${"Result_".$x."_".$i} = $result;
                //$data_ary['Data_Ary_'.$x."_".$i]   = ${"Result_".$x."_".$i};

              

                
            }}
            //$data_ary['Data_Ary_'.$x."_".$i]   = ${"Result_".$x."_".$i};




            for ($x = 0; $x < count($IssueType); $x++) {
                for ($i = 0; $i < count($Location); $i++) {
                    $key = "Result_{$x}_{$i}";
                    if (isset($$key)) {
                        $data_ary['Data_Ary'] = array_merge($data_ary['Data_Ary'], $$key);
                    }
                }
            }


        } 
        catch(PDOException $ex) 
        {
            //$error =  "Error: " . $e->getMessage();
            $Status_ary[0] = "error";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();        
        }    

    }
    $data_ary['Status_Ary'] = $Status_ary;
    
    //$data_ary['Data_Ary1']   = $Result_0_0;
    //$data_ary['Data_Ary2']   = $Result_0_1;
      


print json_encode($data_ary
);
