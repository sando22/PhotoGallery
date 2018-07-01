<?php
include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Upload Image</h2>

            <form class="upload-form" action="includes/upload-inc.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="text" name="tags" placeholder="#your#tags#here">
                <?php
                if (isset($_SESSION['u_id'])) {
                    echo '
                    <div>
                        <label for="public">Public</label>
                        <input type="checkbox" name="public" placeholder="Public upload">
                    </div>
                    ';
                }
                ?>
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>
    </section>

<?php
include_once 'footer.php';
?>