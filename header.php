<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Photo Gallery</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
    <nav>
        <div class="main-wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="upload.php">Upload image</a></li>
                <li>
                    <form action="includes/search-inc.php" method="get">
                        <input type="text" name="search" placeholder="Search...">
                        <button type="submit" name="submitSearch">Search</button>
                    </form>
                </li>
            </ul>

            <div class="nav-login">
                <?php
                if (isset($_SESSION['u_id'])) {
                    echo '
                    <form action="includes/logout-inc.php" method="post">
                        <button type="submit" name="submit">Logout</button>
                     </form>
                     ';
                } else {
                    echo '
                    <form action="includes/login-inc.php" method="post">
                        <input type="text" name="username" placeholder="username">
                        <input type="password" name="password" placeholder="password">
                        <button type="submit" name="submit">Login</button>
                    </form>
                    <a href="signup.php">Sign Up</a>
                ';
                }
                ?>


            </div>
        </div>
    </nav>
</header>