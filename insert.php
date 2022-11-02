<?php
require_once 'db.php';
require_once 'functions.php';


$name = filter_var(htmlspecialchars(strip_tags(trim($_POST['name']))), FILTER_SANITIZE_STRING);
$lastname = filter_var(htmlspecialchars(strip_tags(trim($_POST['lastname']))), FILTER_SANITIZE_STRING);
$role = $_POST['role'];
$switch = $_POST['switcher'];

if ($switch == 'true') {
    $switch = 1;
} else {
    $switch = 0;
}

if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {

    $user_id = $_POST['user_id'];
    $result = updateUser($pdo, $name, $lastname, $role, $switch, $user_id);

    $first_sql = "SELECT * FROM user WHERE id='$user_id '";
    $first_query = $pdo->prepare($first_sql);
    $first_query->execute([]);
    $first_user = $first_query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        http_response_code(200);
        $res = [
            'method' => 'update',
            'status' => true,
            'error' => null,
            'user' => $first_user
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => false,
            'message' => 'User Not Update'
        ];
        echo json_encode($res);
        return;
    }


} else {
    $result = insertUser($pdo, $name, $lastname, $role, $switch);
    $id = $pdo->lastInsertId();

    $sql = "SELECT * FROM user WHERE id='$id'";
    $query = $pdo->prepare($sql);
    $query->execute([]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        http_response_code(201);
        $res = [
            'method' => 'insert',
            'status' => true,
            'error' => null,
            'user' => $user
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => false,
            'message' => 'User not created'
        ];
        echo json_encode($res);
        return;
    }
}


