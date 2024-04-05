<!DOCTYPE html>
<html>
<head>
    <title>Network Traffics</title>
</head>
<body>
    <form action="get_messages.php" method="post">
        <label for="user">Виберіть користувача:</label>
        <select name="user" id="user">
            <?php
            $mongoHost = 'localhost';
            $mongoPort = 27017;
            try {
                $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");
                $query = new MongoDB\Driver\Query([]);
                $users = $mongoManager->executeQuery('network_trafficts.users', $query);

                foreach ($users as $user) {
                    echo "<option value=\"" . $user->login . "\">" . $user->login . "</option>";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {
                echo "Помилка при отриманні користувачів з бази даних: " . $e->getMessage();
            }
            ?>
        </select>
        <button type="submit" name="submit">Отримати повідомлення</button>
    </form>

    <form action="get_traffics.php" method="post">
        <label for="user">Виберіть користувача:</label>
        <select name="user" id="user">
            <?php
            try {
                $mongoManager = new MongoDB\Driver\Manager("mongodb://$mongoHost:$mongoPort");
                $query = new MongoDB\Driver\Query([]);
                $users = $mongoManager->executeQuery('network_trafficts.users', $query);

                foreach ($users as $user) {
                    echo "<option value=\"" . $user->static_ip . "\">" . $user->login . "</option>";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {
                echo "Помилка при отриманні користувачів з бази даних: " . $e->getMessage();
            }
            ?>
        </select>
        <button type="submit" name="submit">Отримати трафік</button>
    </form>

    <p>Список клієнтів з від'ємним балансом рахунку</p>
    <form action="get_negative_balance.php" method="post">
        <button type="submit" name="submit">Отримати клієнтів</button>
    </form>

    <h1>Попередній результат:</h1>
    <div id="messages">Messages does not saved...</div> <br>
    <div id="traffics">Traffics statistics does not saved...</div> <br>
    <div id="negativeBalances">Negative balances does not saved...</div> <br>
    <script>
        (() => {
            document.getElementById("messages").innerHTML = localStorage.getItem("messages") || "Messages does not saved...";
            document.getElementById("traffics").innerHTML = localStorage.getItem("traffics") || "Traffics statistics does not saved...";
            document.getElementById("negativeBalances").innerHTML = localStorage.getItem("negativeBalances") || "Negative balances does not saved...";
        })();
    </script>
</body>
</html>
