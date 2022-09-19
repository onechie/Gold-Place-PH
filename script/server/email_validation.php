<?php
    include './database.php';
    
    if(isset($_POST['regEmail'])) {
        $email = $_POST['regEmail'];

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            echo ' is already used <i class="bi bi-exclamation-circle-fill"></i>';
        }else{
            echo '';
        }
    }

    if(isset($_POST['logEmail'])) {
        $email = $_POST['logEmail'];

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 0) {
            echo ' is not registered <i class="bi bi-exclamation-circle-fill"></i>';
        }else{
            echo '';
        }
    }
?>