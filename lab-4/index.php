<?php

function isPostMethod() {
    return $_SERVER["REQUEST_METHOD"] == "POST";
}

function getCorrectData($filename) {
    return file_get_contents($filename);
}

function isLoginCorrect($login) {
    return $login == getCorrectData("./user/login.txt");
}

function isPasswordCorrect($password) {
    return $password == getCorrectData("./user/password.txt");
}

function successLoginHandler() {
    echo "You logged!";
}

function errorLoginHandler() {
    echo "Invalid login or password. Try again.";
}


if (isPostMethod()) {
    $login = $_POST["login"];
    $password = $_POST["password"];

    if (isLoginCorrect($login) && isPasswordCorrect($password)) {
        successLoginHandler();
    } else {
        errorLoginHandler();
    }
}
?>
