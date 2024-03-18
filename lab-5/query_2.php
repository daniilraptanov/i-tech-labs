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

if ($totalTime) {
    echo "<h2>Total Work Time for Project '$projectName': $totalTime</h2>";
} else {
    echo "No work time found for Project '$projectName'.";
}
?>
