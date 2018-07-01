<?php

if (isset($_GET['search'])) {
    if ($_GET['search'] === '') {
        header("Location: ../index.php?search=empty");
        exit();
    }

    $searchPhrase = $_GET['search'];

    header("Location: ../search.php?search=$searchPhrase");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
