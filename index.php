<?php
include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Home</h2>

            <?php
            if (isset($_SESSION['u_id'])) {
                include_once "user-images.php";
            }

            include_once "public-images.php";
            ?>

        </div>
    </section>

<?php
include_once 'footer.php';
?>