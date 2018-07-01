<?php
include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <?php
            $phrase = $_GET['search'];

            echo "
                    <h2>Search results</h2>
                    <h3>$phrase</h3>
                ";
            ?>

            <?php
            include_once "search-images.php"
            ?>

        </div>
    </section>

<?php
include_once 'footer.php';
?>