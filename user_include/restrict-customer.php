<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == 'customer') {
            http_response_code(403);
            header('location: ../');
        }
    }
} else {
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == 'customer') {
            http_response_code(403);
            header('location: ../');
        }
    }
}
?>