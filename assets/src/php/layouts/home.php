<?php
if (!isset($_SESSION["login"])) {
    echo "<script>location='index.php'</script>";
}
$db->kirim($_SESSION["id"], $_SESSION["login"]);

?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-lg-auto">
            <div class="card border-0 shadow-lg mb-3 px-3">
                <div class="card-header bg-white pb-0">
                    <h3>Hi, <?= $_SESSION["login"] ?>.</h3>
                </div>
                <div class=" card-body">
                    <form action="" method="post" class="text-end">
                        <textarea name="text" class="w-100 form-control mb-3" placeholder="Write what's on your mind" autocomplete="off" autofocus rows="3"><?= @$_GET["text"]; ?></textarea>
                        <?php
                        if (isset($_GET['error5'])) {
                            echo "<p class='text-danger float-start mb-0 ms-2'>" . $_GET['error5'] . "</p>";
                        }
                        ?>
                        <button type="submit" class="btn btn-sm btn-primary" name="kirim"><i class="bi bi-send me-2"></i>Send</button>
                    </form>
                </div>
            </div>
            <?php
            $result = $db->get();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="card border-0 shadow-lg mb-3 px-3">
                        <div class="card-header bg-white pb-0">
                            <?php
                            if ($_SESSION["login"] == $row["judul"]) {
                                $db->hapus($row["id_item"]); ?>
                                <form action="" method="post">
                                    <button type="submit" name="hapus<?= $row["id_item"] ?>" class="bg-transparent text-dark border-0 float-end ms-2" onclick="return confirm('Apakah anda yakin ingin menghapus postingan ini?');if(confirm) return true;else return false;" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            <?php } ?>
                            <?php
                            if ($_SESSION["login"] == $row["judul"]) {
                            ?>
                                <a href="?page=edit&id=<?= $row["id_item"] ?>" class="bg-transparent text-dark float-end ms-3" title="Edit"><i class="bi bi-gear-fill"></i></a>
                            <?php } ?>
                            <a href="https://wa.me/?text=@<?= $row["judul"] ?> : <?= $row["desk"] ?>%0A%0AMau buat kata juga? cek link berikut ini <?= "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" class="bg-transparent text-dark float-end ms-3" title="Share"><i class="bi bi-share-fill"></i></a>
                            <p class="float-end mb-0"><?= $db->nicetime($row["created"]); ?></p>
                            <h5><?php if ($_SESSION["login"] == $row["judul"]) {
                                    echo "You";
                                } else {
                                    echo ucwords($row["judul"]);
                                } ?></h5>
                        </div>
                        <div class="card-body">
                            <p><?= ucwords(nl2br($row["desk"])) ?></p>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>