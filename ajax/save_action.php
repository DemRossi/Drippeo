<?php
    require_once '../bootstrap/bootstrap.php';
    if (!empty($_POST)) {
        $actionId = $_POST['actionId'];
        $userId = $_SESSION['user']['id'];
        $total = $_POST['total'];
        $timestamp = $_POST['timestamp'];
        try {
            $a = new Action();
            $a->setActionId($actionId);
            $a->setUserId($userId);
            $a->setTotal($total);
            $a->setTimestamp($timestamp);
            $a->saveAction();
            $icon = Action::getActionIconById($actionId);
            $result = [
                'status' => 'success',
                'message' => 'Action was saved',
                'data' => [
                    'action' => $actionId,
                    'icon' => $icon,
                    'total' => $total,
                    'time' => $timestamp,
                ],
            ];
        } catch (Throwable $t) {
            //error
            $result = [
                'status' => 'error',
                'message' => $t->getMessage(),
            ];
        }
        echo json_encode($result);
    }
