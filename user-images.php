<?php
include_once "includes/dbh-inc.php";

$u_id = $_SESSION['u_id'];

$getImagesPerUser = "select id, resource from images where creator = '$u_id'";
$result = mysqli_query($conn, $getImagesPerUser);

if (mysqli_num_rows($result) > 0) {
    echo "<h3>Your uploads:</h3>";

    echo '
        <div class="image-wrapper">
    ';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
            <a href="image.php?img=' . $row['id'] . '"><img src="thumbs/' . $row['resource'] . '"></a>
        ';
    }
    echo '
        </div>
    ';
} else {
    echo "<h3>Your haven't uploaded any images!</h3>";
}
