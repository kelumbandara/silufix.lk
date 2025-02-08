<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_name"])) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION["user_name"];

use Shuchkin\SimpleXLSX;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once __DIR__ . '../../../src/SimpleXLSX.php';
require '../../dbconnection/dbConnection.php';

$output = "";

if (isset($_FILES['file'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {
        try {
            $sql2 = "TRUNCATE TABLE tblwo_masterdata_redtag";
            $truncatetable = mysqli_query($conn2, $sql2);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        foreach ($xlsx->readRows() as $k => $row) {
            if ($k == 0) continue; // Skip the first row (headers)
            
            $Site = isset($row[0]) ? $row[0] : '&nbsp;';
            $Location = isset($row[1]) ? $row[1] : '&nbsp;';
            $Building = isset($row[2]) ? $row[2] : '&nbsp;';
            $IssueType = isset($row[3]) ? $row[3] : '&nbsp;';
            $IssueDescriptionMain = isset($row[4]) ? $row[4] : '&nbsp;';
            $IssueDescriptionSub = isset($row[5]) ? $row[5] : '&nbsp;';

            $repIssueDescriptionMain = str_replace(["'", "<", ">", "'", "/"], " ", $IssueDescriptionMain);
            $repIssueDescriptionSub = str_replace(["'", "<", ">", "'", "/"], " ", $IssueDescriptionSub);
            
            $output .= "<tr>
                            <td>$Site</td>
                            <td>$Location</td>
                            <td>$Building</td>
                            <td>$IssueType</td>
                            <td>$repIssueDescriptionMain</td>
                            <td>$repIssueDescriptionSub</td>
                        </tr>";
            
            $sql = "INSERT INTO tblwo_masterdata_redtag (Site, Location, Building, IssueType, IssueDescriptionMain, IssueDescriptionSub) "
                 . "VALUES ('$Site', '$Location', '$Building', '$IssueType', '$repIssueDescriptionMain', '$repIssueDescriptionSub')";
            
            mysqli_query($conn2, $sql);
        }
    } else {
        echo SimpleXLSX::parseError();
    }
}
?>

<?php include_once '../../headers/header.php'; ?>
<?php include '../../headers/top-menu.php'; ?>
<?php include '../../headers/left-sidebar.php'; ?>

<div class="content-wrapper pt-3">
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h2 class="card-title">Master Data Update - Redtag</h2>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <input type="submit" value="Read and Upload" />
                    </form>
                </div>
            </div>

            <?php if (!empty($output)): ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="card-title">Uploaded Data</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Site</th>
                                <th>Location</th>
                                <th>Building</th>
                                <th>Issue Type</th>
                                <th>Issue Description (Main)</th>
                                <th>Issue Description (Sub)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $output; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php include '../../headers/footer-bar.php'; ?>
    </section>
</div>
</body>
</html>
