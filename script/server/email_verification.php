<?php 
    include './database.php';

    if(isset($_POST['code'])) {
    
        $code = $_POST['code'];
        $sql = "SELECT * FROM verify WHERE code = '$code'";
        $result = mysqli_query($conn, $sql);
    
        if(mysqli_num_rows($result) > 0){
          
            while($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['user_id'];
                $sql = "SELECT * FROM user WHERE id = '$user_id'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['verified'] == 'yes'){
                            echo 'Your account is already verified!';
                        } else {
                            $sql = "UPDATE user SET verified = 'yes' WHERE id = '$user_id'";
                            if(mysqli_query($conn, $sql)){
                                echo 'Your account is successfully verified!';
                            } else {
                                echo 'ERROR! Please close the page.';
                            }
                        }
                    }
                } else {
                    echo 'ERROR! Please close the page.';
                }
            }
        } else {
            echo 'ERROR! Please close the page.';
        }
    }
?>