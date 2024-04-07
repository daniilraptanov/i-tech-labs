<?php
include("database.php");

$projectName = $_GET['project_name'];

$sql = "SELECT ROUND(SUM(TIME_TO_SEC(TIMEDIFF(time_end, time_start))) / 3600, 2) AS total_time_hours
        FROM work 
        JOIN project ON work.FID_PROJECTS = project.ID_PROJECTS 
        WHERE project.name = :project_name";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':project_name', $projectName);

$stmt->execute();

$totalTime = $stmt->fetchColumn();

header('Content-Type: text/xml');

$xml = "<?xml version='1.0' encoding='UTF-8'?>";
$xml .= "<response>";
if ($totalTime) {
    $xml .= "<message>Total Work Time for Project '$projectName': $totalTime</message>";
} else {
    $xml .= "<message>No work time found for Project '$projectName'.</message>";
}
$xml .= "</response>";

echo $xml;
?>
