<?php
require_once 'db.php';
require_once 'functions.php';

$action = $_POST['selectSecondAction'];
$user_id = $_POST["id"];

if (($key = array_search('false', $user_id)) !== false) {
    unset($user_id[$key]);
}
$id = implode(',', $user_id);

$countOfExistUser = selectAll($pdo, $id);
$countOfUser = count($user_id);


if (isset($action) && !empty($countOfUser)) {

    if ($action == 'Delete') {

        if ($countOfExistUser == $countOfUser) {
            deleteUserByAction($pdo, $id);
            $res = [
                'status' => true,
                'error' => null
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => false,
                'error' => ['code' => 100, 'message' => 'User (users) not deleted,please refresh the page']
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($action == 1) {
        $switch = 1;


        if ($countOfExistUser == $countOfUser) {
            updateUserBySwitch($pdo, $switch, $id);
            $res = [
                'status' => true,
                'error' => null
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => false,
                'error' => ['code' => 100, 'message' => 'User (users) not updated,please refresh the page']
            ];
            echo json_encode($res);
            return;
        }
    } elseif ($action == 0) {
        $switch = 0;


        if ($countOfExistUser == $countOfUser) {
            updateUserBySwitch($pdo, $switch, $id);
            $res = [
                'status' => true,
                'error' => null
            ];
            echo json_encode($res);
            return;
        } else {
            $res = [
                'status' => false,
                'error' => ['code' => 100, 'message' => 'User (users) not updated,please refresh the page']
            ];
            echo json_encode($res);
            return;
        }
    }
} else {
    $res = [
        'status' => false,
        'error' => ['message' => 'Table is empty']
    ];
    echo json_encode($res);
    return;
}

