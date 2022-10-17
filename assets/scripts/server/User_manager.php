<?php

include 'database.php';
class User_manager
{
    //SPECIFIC USER DATA
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $password;
    public $verified;
    public $type;
    public $purchased;
    public $image;
    public $house;
    public $street;
    public $city;
    public $province;
    public $orders;
    public $cancelled;
    public $delivered;
    public $processing;

    //LIST OF USERS DATA
    public $user_list;

    //FETCH ALL USER DATA
    function fetch_users($conn)
    {
        $result = mysqli_query($conn, "SELECT * FROM user");
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $this->user_list[] = array(
                    "id" => $rows['id'],
                    "first_name" => $rows['firstname'],
                    "last_name" => $rows['lastname'],
                    "email" => $rows['email'],
                    "phone" => $rows['phone'],
                    "password" => $rows['password'],
                    "verified" => $rows['verified'],
                    "type" => $rows['type'],
                    "purchased" => $rows['purchased'],
                    "image" => $this->fetch_image($rows['id'])
                );
            }
        }
    }

    //FETCH SPECIFIC USER DATA
    function fetch_user($conn, $id)
    {
        $result = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'");
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $this->id = $id;
                $this->first_name = $rows['firstname'];
                $this->last_name = $rows['lastname'];
                $this->email = $rows['email'];
                $this->phone = $rows['phone'];
                $this->password = $rows['password'];
                $this->verified = $rows['verified'];
                $this->type = $rows['type'];
                $this->purchased = $rows['purchased'];
                $this->image = $this->fetch_image($id);
            }
        }
    }
    //FETCH USER ADDRESS
    function fetch_address($conn)
    {
        $result = mysqli_query($conn, "SELECT * FROM user_address WHERE user_id = '$this->id'");
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $this->house = $rows['house_number'];
                $this->street = $rows['barangay'];
                $this->city = $rows['city'];
                $this->province = $rows['province'];
            }
        }
    }
    //FETCH USER ORDERS INFO
    function fetch_orders($conn)
    {
        $totalOrders = 0;
        $cancelled = 0;
        $delivered = 0;
        $processing = 0;

        $sql = "SELECT * FROM orders WHERE user_id = '$this->id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $s = $rows['status'];
                if ($s == "cancelled")
                    $cancelled++;
                else if ($s == "delivered")
                    $delivered++;
                else
                    $processing++;

                $totalOrders++;
            }
        }
        $this-> orders = $totalOrders;
        $this -> cancelled = $cancelled;
        $this -> delivered = $delivered;
        $this -> processing = $processing;
    }
    //FETCH USER IMAGE NAME
    function fetch_image($id)
    {

        $specificDirectory = "../../images/users/" . $id;
        if (!is_dir($specificDirectory)) {
            mkdir($specificDirectory);
        }

        $files = array_diff(scandir($specificDirectory), array('..', '.'));
        $file = '';
        //GET THE FILE'S NAME
        foreach ($files as $value) {
            $file = $value;
            break;
        }

        return $file;
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //UPDATES
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

    //UPDATE DATA OF THE CURRENT USER ID WITH SET VALUES
    function update_user($conn)
    {
        mysqli_query(
            $conn,
            "UPDATE user SET firstname='$this->first_name',
            lastname='$this->last_name',
            email='$this->email',
            phone='$this->phone',
            password='$this->password',
            verified='$this->verified',
            type='$this->type',
            purchased='$this->purchased' 
            WHERE id = '$this->id'
        "
        );

        $this->update_image($this->id);
    }
    //UPDATE USER ADDRESS
    function update_address($conn)
    {
        mysqli_query(
            $conn,
            "UPDATE user_address 
            SET house_number = '$this->house',
            barangay = '$this->street',
            city = '$this->city',
            province = '$this->province' 
            WHERE user_id = '$this->id'"
        );
    }
    //UPDATE USER ORDERS
    function update_orders($conn)
    {
        mysqli_query(
            $conn,
            "UPDATE orders WHERE user_id = '$this->id'"
        );
    }
    //UPDATE USER IMAGE
    function update_image($id)
    {
        if ($_FILES["images"]["tmp_name"][0] == null) {
            return "ok";
        }

        $specificDirectory = "../../images/users/" . $id. "/";
        if (!is_dir($specificDirectory)) {
            mkdir($specificDirectory);
        } else {
            $files = glob($specificDirectory . '*');
            foreach ($files as $file) {
                //CHECK IF TRUE FILE
                if (is_file($file)) {
                    //DELETE THE FILE
                    unlink($file);
                }
            }
        }

        $target_file = $specificDirectory . basename($_FILES["images"]["name"][0]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //CHECK IF TRUE IMAGE USING "getimagesize"
        $check = getimagesize($_FILES["images"]["tmp_name"][0]);

        if ($check) {
        } else {
            return 'not_image';
        }

        // CHECK IF FILE ALREADY EXISTS
        if (file_exists($target_file)) {
            return 'image_exists';
        }

        // CHECK FILE SIZE
        if ($_FILES["images"]["size"][0] > 2000000) {
            return 'image_large';
        }

        // CHECK FILE FORMAT
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return 'invalid_format';
        }

        $new_file_name = $specificDirectory . md5($_FILES["images"]["name"][0]) . "." . strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        //INSERT FILE TO SERVER
        if (move_uploaded_file($_FILES["images"]["tmp_name"][0], $new_file_name)) {
            return 'ok';
        } else {
            return 'failed';
        }
    }
    //INSERT USER
    function insert_user($conn)
    {
        return mysqli_query(
            $conn,
            "INSERT INTO user (firstname, lastname, email, password, type)
            VALUES ('$this->first_name', '$this->last_name', '$this->email', '$this->password', '$this->type')"
        );
    }
    //INSERT USER ADDRESS
    function insert_address($conn)
    {
        mysqli_query(
            $conn,
            "INSERT INTO user_address (user_id, house_number, barangay, city, province)
            VALUES ('$this->id', '$this->house ', '$this->street', '$this->city', '$this->province')"
        );
    }
}
