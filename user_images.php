<?php
include_once "includes/dbh-inc.php";

$u_id = $_SESSION['u_id'];

$getImagesPerUser = "select resource from images where creator = '$u_id'";
$result = mysqli_query($conn, $getImagesPerUser);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
              <img src="uploads/' . $row['resource'] . '">
        ';
    }
} else {
    echo "<p>Your haven't uploaded any images!</p>";
}
