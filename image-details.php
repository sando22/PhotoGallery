<?php
include_once "includes/dbh-inc.php";

if (isset($_GET['img'])) {
    if ($_GET['img'] === "") {
        header("Location: ../index.php");
        exit();
    }

    $imgId = $_GET['img'];

    $sql = "select * from images where id = '$imgId';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) !== 1) {
        echo "<h3>There was a problem loading your image!</h3>";
    } else {
        $row = mysqli_fetch_assoc($result);

        if (isset($_SESSION['u_id']) && $_SESSION['u_id'] == $row['creator']) {
            echo '
                <div class="image-details">
                    <button>Delete</button>
                </div>
            ';
        }

        if ($row['public'] != 1 && !(isset($_SESSION['u_id']) && $_SESSION['u_id'] == $row['creator'])) {
            echo '
                <h3>You don\'t have access to that image</h3>
            ';

            exit();
        } else {
            echo '
                <img src="uploads/' . $row['resource'] . '">
            ';
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}