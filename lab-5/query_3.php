<?php
include("database.php");

$chiefName = $_GET['manager'];

$sql = "SELECT COUNT(worker.ID_WORKER) AS num_workers
        FROM worker
        JOIN department ON worker.FID_DEPARTMENT = department.ID_DEPARTMENT
        WHERE department.chief = :chief_name";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':chief_name', $chiefName);

$stmt->execute();

$numWorkers = $stmt->fetchColumn();

if ($numWorkers !== false) {
    echo "<h2>Number of workers under Manager '$chiefName': $numWorkers</h2>";
} else {
    echo "No workers found under Manager '$chiefName'.";
}
?>
