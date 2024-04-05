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

        echo "Загальний вхідний трафік для користувача $selectedUser: $totalIncomingTraffic<br>";
        echo "Загальний вихідний трафік для користувача $selectedUser: $totalOutgoingTraffic<br>";
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Помилка при отриманні трафіку: " . $e->getMessage();
    }
}
?>
