<?php
require_once 'db.php';
require_once 'functions.php';

if (isset($_GET['user_id'])) {

    $id = $_GET['user_id'];
    $sql = 'DELETE FROM `user` WHERE `id`=?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);

    if ($query->rowCount() == 1) {
        http_response_code(200);
        $res = [
            'status' => true,
            'error' => null
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => false,
            'error' => ['code' => 100,'message' => 'User not found']
        ];
        echo json_encode($res);
        return;
    }
}





