<?php
$mongoHost = 'localhost';
$mongoPort = 27017;

if (isset($_POST['submit'])) {
    $selectedUser = $_POST['user'];

    try {
        $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");

        $query = new MongoDB\Driver\Query(["client_ip" => $selectedUser]);
        $cursor = $mongoManager->executeQuery('network_trafficts.sessions', $query);

        $totalIncomingTraffic = 0;
        $totalOutgoingTraffic = 0;

        foreach ($cursor as $session) {
            $totalIncomingTraffic += $session->incoming_traffic;
            $totalOutgoingTraffic += $session->outgoing_traffic;
        }

        $res = "<h2>Трафік користувача $selectedUser</h2>";
        $res.= "Загальний вхідний трафік: $totalIncomingTraffic<br>";
        $res.= "Загальний вихідний трафік: $totalOutgoingTraffic<br>";

        echo $res;
        echo "<script>localStorage.setItem('traffics', '$res');</script>";
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Помилка при отриманні трафіку: " . $e->getMessage();
    }
}
?>
