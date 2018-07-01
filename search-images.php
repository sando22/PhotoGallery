<?php
include_once "includes/dbh-inc.php";

if (isset($_GET['search'])) {
    if ($_GET['search'] === "") {
        header("Location: ../index.php?search=empty");
        exit();
    } else {
        $tag = $_GET['search'];

        $sql = "select * from images where id in (select image_id from tag_to_image where tag_id in (select id from tags where label = '$tag')) and (public = 1";

        if (isset($_SESSION['u_id'])) {
            $u_id = $_SESSION['u_id'];

            $sql = $sql . " or creator = '$u_id');";
        } else {
            $sql = $sql . ");";
        }

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) < 1) {
            echo "<h3>There are no images with this tag!</h3>";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <img src="uploads/' . $row['resource'] . '">
                ';
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}