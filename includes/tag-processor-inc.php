<?php

if (isset($_POST['submit'])) {
    $tags = $_POST['tags'];

    $tags = explode("#", $tags);

    if (sizeof($tags) > 1) {
        $getImageId = "select id from images where resource = '$fileNameNew'";
        $result = mysqli_query($conn, $getImageId);
        if (mysqli_num_rows($result) > 0) {
            $imageId = mysqli_fetch_assoc($result)['id'];

            $getAllTags = "select label from tags";
            $result = mysqli_query($conn, $getAllTags);
            $dbTags = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $existingTags = array();
            foreach ($dbTags as $row) {
                array_push($existingTags, $row['label']);
            }

            $insertTagsSql = "";

            for ($i = 1; $i < sizeof($tags); $i++) {
                if (!in_array($tags[$i], $existingTags)) {
                    if ($insertTagsSql === '') {
                        $insertTagsSql = "insert into tags (label) values ('$tags[$i]')";
                    } else {
                        $insertTagsSql = $insertTagsSql . ", ('$tags[$i]')";
                    }
                }
            }
            if ($insertTagsSql !== '') {
                mysqli_query($conn, $insertTagsSql);
            }

            $getTagsIds = "";
            for ($i = 1; $i < sizeof($tags); $i++) {
                if ($getTagsIds === '') {
                    $getTagsIds = "SELECT id FROM `tags` WHERE label in ('$tags[$i]'";
                } else {
                    $getTagsIds = $getTagsIds . ", '$tags[$i]'";
                }
            }
            $getTagsIds = $getTagsIds . ");";

            $result = mysqli_query($conn, $getTagsIds);

            $connectTagAndImage = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                if ($connectTagAndImage === '') {
                    $connectTagAndImage = "insert into tag_to_image (tag_id, image_id) values('$id','$imageId')";
                } else {
                    $connectTagAndImage = $connectTagAndImage . ", ('$id', '$imageId')";
                }
            }
            $connectTagAndImage = $connectTagAndImage . ";";

            mysqli_query($conn, $connectTagAndImage);
        }
    }
}
