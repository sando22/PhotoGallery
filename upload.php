<?php
include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Upload Image</h2>

            <form action="upload-inc.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>
    </section>

<?php
include_once 'footer.php';
?>