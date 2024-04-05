<?php
$mongoHost = 'localhost';
$mongoPort = 27017;

if (isset($_POST['submit'])) {
    $selectedUser = $_POST['user'];

    try {
        $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");

        $query = new MongoDB\Driver\Query(["login" => $selectedUser]);
        $cursor = $mongoManager->executeQuery('network_trafficts.users', $query);

        $res = "";
        foreach ($cursor as $user) {
            $res.= "<h2>Повідомлення користувача $selectedUser:</h2>";
            foreach ($user->messages as $message) {
                $res.= $message . "<br>";
            }
        }

        echo $res;
        echo "<script>localStorage.setItem('messages', '$res');</script>";
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Помилка при отриманні повідомлень: " . $e->getMessage();
    }
}
?>
