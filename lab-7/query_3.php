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

$response = array();

if ($numWorkers !== false) {
    $response['message'] = "Number of workers under Manager '$chiefName': $numWorkers";
} else {
    $response['message'] = "No workers found under Manager '$chiefName'.";
}

header('Content-Type: application/json');
echo json_encode($response);
?>
