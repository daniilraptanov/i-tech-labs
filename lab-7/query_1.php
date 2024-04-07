<?php
include("database.php");

$projectName = $_GET['project_name'];
$date = $_GET['date'];

$sql = "SELECT work.description 
        FROM work 
        JOIN project ON work.FID_PROJECTS = project.ID_PROJECTS 
        WHERE project.name = :project_name 
        AND work.date = :date";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':project_name', $projectName);
$stmt->bindValue(':date', $date);

$stmt->execute();

$works = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($works) {
    echo "<h2>Works for Project '$projectName' on $date:</h2>";
    echo "<ul>";
    foreach ($works as $work) {
        echo "<li>{$work['description']}</li>";
    }
    echo "</ul>";
} else {
    echo "Works does not found for Project '$projectName' on $date.";
}
?>
