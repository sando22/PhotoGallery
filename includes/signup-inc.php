<?php

if (isset($_POST['submit'])) {
    include_once 'dbh-inc.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

//    Error handlers
//    Check for empty fields
    if (empty($name) || empty($email) || empty($username) || empty($pwd)) {
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
//        Check if name is valid
        if (!preg_match("/^[a-zA-Z]*$/", $name)) {
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
//            Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?signup=email");
                exit();
            } else {
//                Check username exists
                $sql = "select * from users where username='$username'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                } else {
//                   Hashing the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
//                   Insert the user into the DB
                    $sql = "insert into users (name, email, username, pwd) values ('$name', '$email', '$username', '$hashedPwd');";
                    mysqli_query($conn, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}