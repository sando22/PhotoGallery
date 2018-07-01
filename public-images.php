<?php
include_once "includes/dbh-inc.php";

$getPublicImages = "select id, resource from images where public = 1";

if (isset($_SESSION['u_id'])) {
    $u_id = $_SESSION['u_id'];
    $getPublicImages = $getPublicImages . " and creator != '$u_id'";
}

$result = mysqli_query($conn, $getPublicImages);

if (mysqli_num_rows($result) > 0) {
    echo "<h3>Public uploads:</h3>";

    echo '
        <div class="image-wrapper">
    ';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
              <a href="image.php?img=' . $row['id'] . '"><img src="thumbs/' . $row['resource'] . '"></a>
        ';
    }
    echo '
        <div>
    ';
} else {
    echo "<h3>There are no public images yet!</h3>";
}
