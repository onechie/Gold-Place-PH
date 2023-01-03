<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == 'super_admin') {
            http_response_code(403);
            header('location: system_admin/');
        }
    }
} else {
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == 'super_admin') {
            http_response_code(403);
            header('location: system_admin/');
        }
    }
}
?>