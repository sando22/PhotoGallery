<?php

if (isset($_POST['submit'])) {
    $srcPath = $fileDestination;

    ignore_user_abort(true);
    set_time_limit(120);

    $srcSize = getimagesize($srcPath);

    if ($srcSize === false) {
        header("Location: ../index.php");
        exit();
    }

    $thumbWidth = 250;
    $thumbHeight = 200;

    if ($srcSize['mime'] === 'image/jpeg') {
        $src = imagecreatefromjpeg($srcPath);
    } else if ($srcSize['mime'] === 'image/png') {
        $src = imagecreatefrompng($srcPath);
    }

    $srcAspect = round($srcSize[0] / $srcSize[1], 1);
    $thumbAspect = round($thumbWidth / $thumbHeight, 1);

    if ($srcAspect < $thumbAspect) {
        $newSize = array($thumbWidth, $thumbWidth / $srcSize[0] * $srcSize[1]);
        $pos = array(0, ($newSize[1] - $thumbHeight) * ($srcSize[1] / $newSize[1]) / 2);
    } else if ($srcAspect > $thumbAspect) {
        $newSize = array($thumbHeight / $srcSize[1] * $srcSize[0], $thumbHeight);
        $pos = array(($newSize[0] - $thumbWidth) * ($srcSize[0] / $newSize[0]) / 2, 0);
    } else {
        $newSize = array($thumbWidth, $thumbHeight);
        $pos = array(0, 0);;
    }

    if ($newSize[0] < 1) $newSize[0] = 1;
    if ($newSize[1] < 1) $newSize[1] = 1;

    $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);
    imagecopyresampled($thumb, $src, 0, 0, $pos[0], $pos[1], $newSize[0], $newSize[1], $srcSize[0], $srcSize[1]);

    if ($srcSize['mime'] === 'image/jpeg') {
        imagejpeg($thumb, "../thumbs/" . $fileNameNew);
    } else if ($srcSize['mime'] === 'image/png') {
        imagepng($thumb, "../thumbs/" . $fileNameNew);
    }
} else {
    header("Location: ../index.php");
    exit();
}

