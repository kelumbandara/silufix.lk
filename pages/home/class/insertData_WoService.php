<?php

session_start();   
require_once('../../../initialize.php');
require_once('../../../config.php');

//----------- Set TimeZone ----------------------------
date_default_timezone_set('Asia/Kolkata');
$strServerDateTime = date("Y-m-d H:i:s");   

// Get current week number
date_default_timezone_set('Asia/Kolkata');
$WeekNo = date("W"); 
echo $WeekNo;
echo "<br>";

// Declare variables
$Status_ary = array();
$ReturnData_ary = array();
$ReturnData_ary[0] = "NA";  
$i = 0; // Initialize counter

try 
{
    $strSqlString = "SELECT * FROM tblwo_masterdata_service WHERE WeekNo = :wkno AND State = 0";
    echo $strSqlString;
    echo "<br>";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                       
    $stmt = $conn->prepare($strSqlString);
    $stmt->bindParam(':wkno', $WeekNo, PDO::PARAM_INT); 
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);        
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);        

    foreach ($result as $row) 
    {   

        //------ UPDATE State = 1 ----------------------------------------
        $ID = $row['ID'];  // Assuming 'ID' is the primary key column
        //echo "Updating record ID: " . $ID . "<br>";
        // UPDATE Query to set State = 1
        $updateSql = "UPDATE tblwo_masterdata_service SET State = 1 WHERE ID = :id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':id', $ID, PDO::PARAM_INT);
        $updateStmt->execute();        
        //echo "Updated record ID: " . $ID . " to State = 1 <br>";
        
        //$rowData = array();
        //$ID             = $row['ID'];
        $FileNo         = $row['FileNo'];  // Use actual column name
        $ServiceSection = $row['ServiceSection'];       
        $ListOfMachinery    = $row['ListOfMachinery'];
        $Quantity           = $row['Quantity'];
        $TypeOfService      = $row['TypeOfService'];
        $ResponciblePerson  = $row['ResponciblePerson'];
        $Contractor         = $row['Contractor'];
        $TimeFrequency      = $row['TimeFrequency'];
        $PreArrangement     = $row['PreArrangement'];        
        $PlannedDateTime    = $row['PlannedDateTime'];
        $State              = $row['State'];
   
        // Sample Data
        $FactoryCode         = "MMS-1810A";    //'WMS-1760A';
        $Unit                = "Unit-1";    //'Unit-1';
        $RelatedDepartment   = "RelatedDep";    //'RelatedDep';
        $WorkOrderNo         = 'NA';    //'WO_TEMP';
        $WorkOrderCategory       = "Service";  //Work order Category
        $WorkOrderSubCategory    = "";  // Work order Sub Category
        $WorkOrderSubCategory2   = ""; // Work order Sub Category2

        $Site                = "";      //YourDepartment';
        $Location            = "";
        $Building            = "";   
        $IssueType           = "";
        $IssueDescriptionMain    = "";
        $IssueDescriptionSub     = "";

        $Note                = "";
        $CreatedDateTime     = $strServerDateTime;
        $CreatedDepartment   = "";
        $CreatedUser         = "";
        $PlannedDateTime     = "";
        $AllocatedUser       = ''; // Placeholder value
        $RespondDateTime     = '';
        $RespondUser         = ''; // Placeholder value
        $ClosedDateTime      = $strServerDateTime;
        $ClosedUser          = ''; // Placeholder value
        $FaultType           = ''; // Placeholder value
        $UsedSpairParts      = ''; // Placeholder value
        $Remark              = ''; // Placeholder value
        $VerifiedDateTime    = $strServerDateTime;
        $VerifiedUser        = ''; // Placeholder value
        $WoDescription       = "";
        $WoEventLog          = "Auto Created a Service on " . $strServerDateTime;
        $Shift               = '';
        $WoStatus            = "";
        $AlertSentState      = "";
        $Attachment          = "";
        $State               = 0;
  
        //UPDATE tblprod_setting SET ID=?,WorkCenterNo=?,WorkCenterName=?,StyleNo=?,LowerValue=?,UpperValue=?,SMV=?,LowerColor=?,MiddleColor=?,UpperColor=?,State=? WHERE ID=?
        try
        {
            $stmt2 = $conn->prepare("SELECT ID FROM tblwo_event ORDER BY ID DESC LIMIT 1");
            $stmt2->execute();
            $lastID = $stmt2->fetchColumn();
            if ($lastID !== false) 
            {
                // Increment the last ID and format it as "WO_00000001"
                $WorkOrderNo = sprintf("WO_%08d", $lastID + 1);
            }
        } 
        catch (Exception $ex) 
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage(); 
        } 
        //------------------- Insert Data to WO ---------------------------------
        try 
        {    
            $stmt = $conn->prepare("INSERT INTO tblwo_event(ServerDateTime, FactoryCode, Unit, RelatedDepartment, WorkOrderNo, WorkOrderCategory, WorkOrderSubCategory, WorkOrderSubCategory2, Site, Location, Building, IssueType, IssueDescriptionMain, IssueDescriptionSub, Note, CreatedDateTime, CreatedDepartment, CreatedUser, PlannedDateTime, AllocatedUser, RespondDateTime, RespondUser, ClosedDateTime, ClosedUser, FaultType, UsedSpairParts, Remark, VerifiedDateTime, VerifiedUser, WoDescription, WoEventLog, Shift, WoStatus, AlertSentState, Attachment, State) 
                        VALUES (:svrdt, :faccod, :unit, :reldep, :wono, :wocat, :wosubcat, :wosubcat2, :site1, :location, :bldg, :issuetype, :issuedesc1, :issuedesc2, :note, :credt, :credep, :creusr, :plndt, :alocusr, :stddt, :stdusr, :clsdt, :clsusr, :fltType, :spairparts, :remark, :veridt, :verusr, :wodescrip, :woevntlog, :shft, :wostats, :altsntst, :attach, :stat)");
                        // Bind parameters
            $stmt->bindParam(':svrdt', $strServerDateTime);
            $stmt->bindParam(':faccod', $FactoryCode);
            $stmt->bindParam(':unit', $Unit);
            $stmt->bindParam(':reldep', $RelatedDepartment);
            $stmt->bindParam(':wono', $WorkOrderNo);
            $stmt->bindParam(':wocat', $WorkOrderCategory);
            $stmt->bindParam(':wosubcat', $WorkOrderSubCategory);
            $stmt->bindParam(':wosubcat2', $WorkOrderSubCategory2);
            $stmt->bindParam(':site1', $Site);
            $stmt->bindParam(':location', $Location);
            $stmt->bindParam(':bldg', $Building);
            $stmt->bindParam(':issuetype', $IssueType);
            $stmt->bindParam(':issuedesc1', $IssueDescriptionMain);
            $stmt->bindParam(':issuedesc2', $IssueDescriptionSub);
            $stmt->bindParam(':note', $Note);
            $stmt->bindParam(':credt', $CreatedDateTime);
            $stmt->bindParam(':credep', $CreatedDepartment);
            $stmt->bindParam(':creusr', $CreatedUser);
            $stmt->bindParam(':plndt', $PlannedDateTime);
            $stmt->bindParam(':alocusr', $AllocatedUser);
            $stmt->bindParam(':stddt', $RespondDateTime);
            $stmt->bindParam(':stdusr', $RespondUser);
            $stmt->bindParam(':clsdt', $ClosedDateTime);
            $stmt->bindParam(':clsusr', $ClosedUser);
            $stmt->bindParam(':fltType', $FaultType);
            $stmt->bindParam(':spairparts', $UsedSpairParts);
            $stmt->bindParam(':remark', $Remark);
            $stmt->bindParam(':veridt', $VerifiedDateTime);
            $stmt->bindParam(':verusr', $VerifiedUser);
            $stmt->bindParam(':wodescrip', $WoDescription);
            $stmt->bindParam(':woevntlog', $WoEventLog);
            $stmt->bindParam(':shft', $Shift);
            $stmt->bindParam(':wostats', $WoStatus);
            $stmt->bindParam(':altsntst', $AlertSentState);
            $stmt->bindParam(':attach', $Attachment);
            $stmt->bindParam(':stat', $State);

            $stmt->execute();
            if ($stmt->rowCount() > 0) 
            {
                $Status_ary[0] = "true";
                $Status_ary[1] = "Inserted new record"; 
            } 
            else
            {
                $Status_ary[0] = "false";
                $Status_ary[1] = "Data not inserted"; 
            }      
            //$data[1] = "Dats Saved Successfully";   
        } 
        catch (PDOException $ex) 
        {
            $Status_ary[0] = "false";
            $Status_ary[1] = 'Error Msg: ' .$ex->getMessage();         
        }        
        //--------------------------
        $i++;
    }   
} 
catch (PDOException $e) 
{
    $Status_ary[0] = "false";
    $Status_ary[1] = 'Error Msg: ' . $e->getMessage();          
}

if ($i === 0)
{
    $ReturnData_ary[0] = "NA";   
}

$conn = null;

$data_ary['Status_Ary'] = $Status_ary;
$data_ary['Data_Ary']   = $ReturnData_ary;        

print json_encode($data_ary); 

?>
