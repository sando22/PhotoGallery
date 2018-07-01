<?php
session_start();
include_once "dbh-inc.php";

if (isset($_POST['delete']) && isset($_POST['imageId'])) {
    $u_id = $_SESSION['u_id'];
    $imageId = $_POST['imageId'];
    $imageResource = $_POST['imageResource'];

    if (!unlink("../uploads" . $imageResource)) {
        echo '
            <p>File was not deleted!</p>
        ';
    } else {
        echo '
            <p>File was deleted!</p>
        ';
    }

    $deleteImage = "delete from images where id = '$imageId'";
    $deleteTagsRelations = "delete from tag_to_image where image_id = '$imageId'";

    mysqli_query($conn, $deleteImage);
    mysqli_query($conn, $deleteTagsRelations);

    header("Location: ../index.php?delete=success");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
