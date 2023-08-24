<?php
####### db config ##########
$db_username = 'root';
$db_password = '';
$db_name = 'tourism_db';
$db_host = 'localhost';

####### db config end ##########

if ($_POST) {
    $sql_con = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('could not connect to database');

    //Periksa apakah itu permintaan ajax, keluar jika tidak

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }

    if (isset($_POST["message"]) &&  strlen($_POST["message"]) > 0) {

        //Anda bisa mengganti username dengan username terdaftar, jika hanya pengguna terdaftar yang diijinkan mengirim pesan

        $username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }

        if (mysqli_query($sql_con, "INSERT INTO shout_box(user, message, ip_address) value('$username','$message','$user_ip')")) {
            if (mysqli_query($sql_con, "SELECT user, message, ip_address FROM shout_box where ip_address = '$user_ip")) {
                $msg_time = date('h:i A M d', time()); // current time
                echo '<div class="shout_msg"><time>' . $msg_time . '</time><span class="username">' . $username . '</span><span class="message">' . $message . '</span></div>';
            }
        }

        // Hapus semua pesan kecuali 10 terakhir, jika Anda tidak ingin memperbesar ukuran db Anda!

        mysqli_query($sql_con, "DELETE FROM shout_box WHERE id NOT IN (SELECT * FROM (SELECT id FROM shout_box ORDER BY id DESC LIMIT 0, 10) as sb)");
    } elseif ($_POST["fetch"] == 1) {
        $user_ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        // var_dump($user_ip); //$user_ip == ::1
        // $results = mysqli_query($sql_con,"SELECT user, message, date_time FROM (select * from shout_box where ip_address='$user_ip' ORDER BY id DESC) shout_box WHERE shout_box.ip_address ='$user_ip'  ORDER BY shout_box.id ASC");
        // while($row = mysqli_fetch_array($results))
        // {
        //     $msg_time = date('h:i A M d',strtotime($row["date_time"])); 

        //     echo '<div class="shout_msg"><time>'.$msg_time.'</time><span class="username">'.$row["user"].'</span> <span class="message">'.$row["message"].'</span></div>';
        // }
        $results = mysqli_query($sql_con, "SELECT user, message, date_time FROM (SELECT * FROM shout_box WHERE ip_address='$user_ip' ORDER BY id DESC) shout_box WHERE shout_box.ip_address ='$user_ip'  ORDER BY shout_box.id ASC");
        $adminOnline = mysqli_query($sql_con,"SELECT isAktive, username FROM users WHERE isAktive=1 AND id =1");
        if ($results) {
            if (mysqli_num_rows($results) > 0) {
                if (mysqli_num_rows($adminOnline) > 0) {
                    echo '<div class="admin_status" style="
                    background-color: #07b519;"> <span class="message">' . "Admin Online" . '</span></div>';
                } else {
                    echo '<div class="admin_status" style="background-color:#ed0f07;"> <span class="message">' . "Admin Offline" . '</span></div>';
                }
                while ($row = mysqli_fetch_array($results)) {
                    $msg_time = date('h:i A M d', strtotime($row["date_time"]));
                    echo '<div class="shout_msg"><time>' . $msg_time . '</time><span class="username">' . $row["user"] . '</span> <span class="message">' . $row["message"] . '</span></div>';
                }
                
            } else {
                if (mysqli_num_rows($adminOnline) > 0) {
                    echo '<div class="admin_status" style="
                    background-color: #07b519;"> <span class="message">' . "Admin Online" . '</span></div>';
                } else {
                    echo '<div class="admin_status" style="background-color:#ed0f07;"> <span class="message">' . "Admin Offline" . '</span></div>';
                }
                echo 'Silahkan masukkan username dan pesan';
                
            }
        } else {
            echo 'Error: ' . mysqli_error($sql_con);
        }
    } else {
        header('HTTP/1.1 500 Are you kiddin me?');
        exit();
    }
}