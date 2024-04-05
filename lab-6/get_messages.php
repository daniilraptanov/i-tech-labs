<?php
$mongoHost = 'localhost';
$mongoPort = 27017;

if (isset($_POST['submit'])) {
    $selectedUser = $_POST['user'];

    try {
        $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");

        $query = new MongoDB\Driver\Query(["login" => $selectedUser]);
        $cursor = $mongoManager->executeQuery('network_trafficts.users', $query);

        foreach ($cursor as $user) {
            echo "Повідомлення користувача $selectedUser: " . "<br>";
            foreach ($user->messages as $message) {
                echo $message . "<br>";
            }
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Помилка при отриманні повідомлень: " . $e->getMessage();
    }
}
?>
