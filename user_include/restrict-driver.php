<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == 'driver') {
            http_response_code(403);
            header('location: driver/');
        }
    }
} else {
    if (isset($_SESSION['userId'])) {
        if ($_SESSION['userType'] == 'driver') {
            http_response_code(403);
            header('location: driver/');
        }
    }
}
?>