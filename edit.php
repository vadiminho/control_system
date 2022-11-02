<?php
require_once 'db.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "SELECT * FROM user WHERE id='$user_id'";
    $query = $pdo->prepare($sql);
    $query->execute([]);

    if ($query->rowCount() == 1) {
        $user = $query->fetch(PDO::FETCH_ASSOC);

        $res = [
            'status' => true,
            'error' => null,
            'data' => $user
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


