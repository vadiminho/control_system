<?php

function insertUser($pdo, $name, $lastname, $role, $switch)
{
    $sql = 'INSERT INTO user(name,lastname,role,switch) VALUES (?,?,?,?)';
    $query = $pdo->prepare($sql);
    return $query->execute([$name, $lastname, $role, $switch]);
}

function updateUser($pdo, $name, $lastname, $role, $switch, $user_id)
{
    $sql = "UPDATE user SET name=?,lastname=?,role=?,switch=? WHERE id=?";
    $query = $pdo->prepare($sql);
    return $query->execute([$name, $lastname, $role, $switch, $user_id]);
}

function deleteUser($pdo, $id)
{
    $sql = 'DELETE FROM `user` WHERE `id`=?';
    $query = $pdo->prepare($sql);
    return $query->execute([$id]);
}

function updateUserBySwitch($pdo, $switch, $id)
{
    $sql = "UPDATE `user` SET `switch`=? WHERE `id` IN ($id)";
    $query = $pdo->prepare($sql);
    return $query->execute([$switch]);
}

function selectAll($pdo, $user_id)
{
    $sql = "SELECT * FROM `user` WHERE `id` IN ($user_id)";
    $query = $pdo->prepare($sql);
    $query->execute([$user_id]);
    return count($query->fetchAll(PDO::FETCH_ASSOC));
}

function deleteUserByAction($pdo, $user_id)
{
    $sql = "DELETE FROM `user` WHERE `id`IN ($user_id)";
    $query = $pdo->prepare($sql);
    return $query->execute([]);
}

