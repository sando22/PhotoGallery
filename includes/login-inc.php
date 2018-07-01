<?php

session_start();

if (isset($_POST['submit'])) {
    include_once "dbh-inc.php";

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

//    Error handlers
//    Check if empty input
    if (empty($username) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "select * from users where username='$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck < 1) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if ($row = mysqli_fetch_assoc($result)) {
//                De-hashing password
                $hashPwdCheck = password_verify($pwd, $row['pwd']);

                if ($hashPwdCheck == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif ($hashPwdCheck == true) {
//                    Login the user
                    $_SESSION['u_id'] = $row['id'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}