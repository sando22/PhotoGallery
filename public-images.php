<?php
include_once "includes/dbh-inc.php";

$getPublicImages = "select resource from images where public = 1";

if (isset($_SESSION['u_id'])) {
    $u_id = $_SESSION['u_id'];
    $getPublicImages = $getPublicImages . " and creator != '$u_id'";
}

$result = mysqli_query($conn, $getPublicImages);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
              <img src="uploads/' . $row['resource'] . '">
        ';
    }
} else {
    echo "<p>There are no public images yet!</p>";
}