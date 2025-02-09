<?php
require_once 'database.php';

function addUser($user) : int
{
    $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

    $query = getPdo()->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $query->execute([
        "username"=> $user['username'],
        "password"=> $user['password']
    ]);

    return getPdo()->lastInsertId();
}