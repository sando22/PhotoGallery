<?php
include_once "dbh-inc.php";
session_start();

if (isset($_POST['submit'])) {
//    $tags = explode('#', $_POST['tags']);
//    print_r($tags);
//    exit();

    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../uploads/' . $fileNameNew;

                $creator = $_SESSION['u_id'];
                $public = $creator != null ? $_POST['public'] : 1;

                $imageInsertSql = "insert into images (creator, public, resource) values ('$creator', '$public', '$fileNameNew');";
                mysqli_query($conn, $imageInsertSql);

                include_once "tag-processor-inc.php";

                move_uploaded_file($fileTmpName, $fileDestination);

                header("Location: ../index.php?upload=success");
                exit();
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
} else {
    header("Location: ../index.php");
    exit();
}