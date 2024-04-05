<?php
$mongoHost = 'localhost';
$mongoPort = 27017;

try {
    $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");

    $query = new MongoDB\Driver\Query(["account_balance" => ['$lt' => 0]]);
    $cursor = $mongoManager->executeQuery('network_trafficts.users', $query);

    echo "<h2>Список клієнтів з від'ємним балансом рахунку:</h2>";
    foreach ($cursor as $user) {
        echo "Користувач: " . $user->login . ", Баланс: " . $user->account_balance . "<br>";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Помилка при отриманні клієнтів з від'ємним балансом: " . $e->getMessage();
}
?>
