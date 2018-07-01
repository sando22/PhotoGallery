<?php
include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Image Details</h2>

            <?php
            if (isset($_GET['img'])) {
                include_once "image-details.php";
            } else {
                header("Location: index.php");
            }
            ?>

        </div>
    </section>

<?php
include_once 'footer.php';
?>